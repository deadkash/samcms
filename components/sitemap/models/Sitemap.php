<?php
/**
 * Модель карты сайта
 *
 * @project SamCMS
 * @package Sitemap
 * @author Kash
 * @date 27.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class SitemapModelSitemap extends Model {

    /**
     * Класс роутер
     * @var Router
     */
    protected $router;

    /**
     * Конструктор
     */
    public function __construct(){

        $this->router = Router::create();
        parent::__construct();
    }

    /**
     * Возвращает элементы меню
     * @return array
     */
    public function getSitemapItems(){

        $menus = $this->getMenuList();

        $output = array();
        foreach ($menus as $menu) {

            $items = $this->getItemsRec($menu->id, 0);
            $output[] = $items;
        }

        return $output;
    }

    /**
     * Возвращает элементы меню линейно для xml
     * @return array
     */
    public function getXMLSitemapItems() {

        $menus = $this->getMenuList();

        $output = array();
        foreach ($menus as $menu) {

            $items = $this->getItemsLinear($menu->id, 0, true);
            $output = array_merge($output, $items);
        }

        return $output;
    }

    /**
     * Возвращает список меню
     * @return array|bool
     */
    private function getMenuList(){

        $query = "SELECT `id`,`title`
                    FROM `menu`
                   WHERE `hide`=0
                ORDER BY `id`;";

        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает пункты меню
     *
     * @param $menuId
     * @param $parentId
     * @return array|bool
     */
    private function getItems($menuId, $parentId) {

        $menuId = (int) $menuId;
        $parentId = (int) $parentId;
        $query = "SELECT `id`,
                         `menu_id`,
                         `title`,
                         `component`
                    FROM `menu_items`
                   WHERE `menu_id`=".$menuId." AND
                         `active`=1 AND
                         `parent`=".$parentId." AND
                         `hide`=0 AND
                         `visible`=1 AND
                         `link`=''
                ORDER BY `ordering`;";

        $this->db->setQuery($query);
        $items = $this->db->getObjectList();

        $currentId = Request::getInt('id');
        foreach ($items as $item) {
            $item->url = $this->router->getUrl(array('id' => $item->id));
            if ($item->id == $currentId) $item->current = true;
        }

        return $items;
    }

    /**
     * Возвращает элементы линейно
     * @param $menuId
     * @return array|bool
     */
    public function getItemsLinear($menuId){

        $menuId = (int) $menuId;
        $query = "SELECT `m`.`id`,
                         `m`.`menu_id`,
                         `m`.`component`,
                         `m`.`title`,
                         `m`.`modified`,
                         `s1`.`value` AS `frequency`,
                         `s2`.`value` AS `priority`
                    FROM `menu_items` AS `m`
               LEFT JOIN `section_parameters` AS `s1`
                      ON (`m`.`id`=`s1`.`section_id` AND `s1`.`name`='seo_frequency')
               LEFT JOIN `section_parameters` AS `s2`
                      ON (`m`.`id`=`s2`.`section_id` AND `s2`.`name`='seo_priority')
                   WHERE `m`.`menu_id`=".$menuId." AND `m`.`active`=1 AND `m`.`hide`=0 AND `m`.`link`='';";
        $this->db->setQuery($query);
        $items = $this->db->getObjectList();
        $componentItems = array();

        foreach ($items as &$item) {

            $item->modified = DatetimeHelper::getSitemapDate($item->modified);
            $item->url = $this->router->getUrl(array('id' => $item->id));

            $subitems = $this->getComponentItems($item);
            if ($subitems) $componentItems = array_merge($componentItems, $subitems);
        }

        $items = array_merge($items, $componentItems);

        return $items;
    }

    /**
     * Возвращает элементы компонента
     * @param $item
     * @return mixed
     */
    private function getComponentItems($item) {

        $plugin = $this->getSitemapPlugin($item->component);
        if (!$plugin) return false;

        return $plugin->getItems($item);
    }

    /**
     * Возвращает класс плагина
     * @param $component
     * @return mixed
     */
    private function getSitemapPlugin($component) {

        $pluginPath = APP_PATH.'plugins/sitemap/'.$component.'.php';
        if (file_exists($pluginPath)) {
            require_once($pluginPath);
        }

        $pluginClass = $component.'Sitemap';
        if (class_exists($pluginClass)) {
            return new $pluginClass();
        }

        return false;
    }

    /**
     * Возвращает разделы рекурсивно
     * @param $menuId
     * @param $parentId
     * @return array
     */
    private function getItemsRec($menuId, $parentId) {

        $items = $this->getItems($menuId, $parentId);
        foreach ($items as &$item) {

            $subitems = $this->getItemsRec($menuId, $item->id);
            $item->subitems = $subitems;

            $componentItems = $this->getComponentItems($item);
            if ($componentItems) $item->subitems = array_merge($item->subitems, $componentItems);
        }

        return $items;
    }
}