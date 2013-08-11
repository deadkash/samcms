<?php

/**
 * Навигация по сайту
 *
 * @project SamCMS
 * @package Pathline
 * @auhtor Kash
 * @date 19.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Pathline extends Module {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'pathline/template.twig';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Имя модуля
     * @var string
     */
    public $name = 'Pathline';

    /**
     * Отрисовка html кода
     * @return string
     */
    public function render() {

        //Если есть в кэше
        if ($html = Cache::get($this, $this->cacheTime)) return $html;

        $this->data = Parameters::getModuleParametersByLabel($this->label, $this->name, $this->itemId);
        $items = $this->getItems();
        $router = Router::create();
        foreach ($items as &$item) {
            $item->href = $router->getUrl(array('id' => $item->id));
            $item->default = ($item->id == $this->itemId);
        }
        $this->data['items'] = $items;

        return parent::render();
    }

    /**
     * Возвращает список разделов
     * @return array
     */
    private function getItems() {

        $items = array();

        $query = "SELECT `id`,`title`,`parent`
                    FROM `menu_items`
                   WHERE `id`=".$this->itemId.";";
        $db = DB::create();
        $db->setQuery($query);
        $item = $db->getObject();
        $items[] = $item;

        $parent = $item->parent;
        while ($parent != 0) {

            $parent = $item->parent;
            $query = "SELECT `id`,`title`,`parent`
                        FROM `menu_items`
                       WHERE `id`=".$item->parent.";";
            $db->setQuery($query);

            $item = $db->getObject();
            if ($item) $items[] = $item;
        }

        $query = "SELECT `id`,`title`
                    FROM `menu_items`
                   WHERE `id`=".Parameters::getParameter('default_section').";";
        $db = DB::create();
        $db->setQuery($query);
        $items[] = $db->getObject();

        $items = array_reverse($items);

        return $items;
    }
}