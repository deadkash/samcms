<?php

/**
 * Модуль для отображения меню
 *
 * @project SamCMS
 * @package module
 * @author Kash
 * @date 07.10.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Menu extends Module {

    /**
     * Название модуля
     * @var string
     */
    public $name = 'Menu';

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'menu/templates/';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Класс бд
     * @var DB
     */
    private $db;

    /**
     * Открыть все подменю
     * @var bool
     */
    private $openAll = false;

    /**
     * Конструктор
     */
    public function __construct() {
        $this->router = Router::create();
        $this->db = DB::create();
    }

    /**
     * Отрисовка html кода
     * @return string
     */
    public function render() {

        //Если есть в кэше
        if ($html = Cache::get($this, $this->cacheTime)) return $html;

        $parameters = Parameters::getModuleParametersByLabel($this->label, $this->name, $this->itemId);

        if (isset($parameters['menu_id'])) $menuId = $parameters['menu_id'];
        else return '';

        if (isset($parameters['template'])) $template = $parameters['template'];
        else return '';

        if (isset($parameters['open_all'])) $this->openAll = $parameters['open_all'];

        $path = $this->getPath($this->itemId);

        $items = $this->getItemsRec($menuId, 0, $path);
        $this->tplPath = $this->tplPath.$template;
        $this->data = array('items' => $items);

        return parent::render();
    }

    /**
     * Возвращает пункты меню
     *
     * @param $menuId
     * @param $parentId
     * @param $path
     * @return array|bool
     */
    private function getItems($menuId, $parentId, $path) {

        $menuId = (int) $menuId;
        $parentId = (int) $parentId;
        $query = "SELECT `id`,
                         `menu_id`,
                         `title`
                    FROM `menu_items`
                   WHERE `menu_id`=".$menuId." AND `active`=1 AND `parent`=".$parentId." AND `visible`=1
                ORDER BY `ordering`;";

        $this->db->setQuery($query);
        $items = $this->db->getObjectList();

        $currentId = Request::getInt('id');
        foreach ($items as $item) {
            $item->url = $this->router->getUrl(array('id' => $item->id));
            if ($item->id == $currentId) $item->current = true;
            if ($this->isActiveParent($item->id, $path)) $item->current = true;
        }

        return $items;
    }

    /**
     * Возвращает разделы рекурсивно
     * @param $menuId
     * @param $parentId
     * @param $path
     * @return array
     */
    private function getItemsRec($menuId, $parentId, $path) {

        $items = $this->getItems($menuId, $parentId, $path);
        foreach ($items as &$item) {

            //Если текущий раздел или открыты все
            if ($item->id == $this->itemId || $this->openAll || $this->isActiveParent($item->id, $path)) {
                $subitems = $this->getItemsRec($menuId, $item->id, $path);
                $item->subitems = $subitems;
            }
        }
        return $items;
    }

    /**
     * Активный родитель
     * @param $itemId
     * @param $path
     * @return bool
     */
    private function isActiveParent($itemId, $path) {
        return in_array($itemId, $path);
    }

    /**
     * Возвращает путь по родителям
     * @param $itemId
     * @return array
     */
    private function getPath($itemId) {

        $items = array();

        $query = "SELECT `id`,`parent`
                    FROM `menu_items`
                   WHERE `id`=".$itemId.";";
        $this->db->setQuery($query);
        $item = $this->db->getObject();
        $items[] = $item->id;

        $parent = $item->parent;
        while ($parent != 0) {

            $parent = $item->parent;
            $query = "SELECT `id`,`parent`
                        FROM `menu_items`
                       WHERE `id`=".$item->parent.";";
            $this->db->setQuery($query);

            $item = $this->db->getObject();
            if ($item) $items[] = $item->id;
        }

        return $items;
    }
}