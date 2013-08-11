<?php

/**
 * Модуль для отображения меню
 *
 * @project SamCMS
 * @package Menu
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
     * Конструктор
     */
    public function __construct() {
        $this->db = DB::create();
    }

    /**
     * Отрисовка html кода
     * @return string
     */
    public function render() {

        $parameters = Parameters::getModuleParametersByLabel($this->label, $this->name, $this->itemId);

        if (isset($parameters['menu_id'])) $menuId = $parameters['menu_id'];
        else return '';

        if (isset($parameters['template'])) $template = $parameters['template'];
        else return '';

        $items = $this->getItems($menuId);
        $this->tplPath = $this->tplPath.$template;
        $this->data = array('items' => $items);

        return Templater::render('modules', $this->tplPath, $this->data);
    }

    /**
     * Возвращает пункты меню
     *
     * @param $menuId
     * @return array|bool
     */
    private function getItems($menuId) {

        $router = Router::create();

        $query = "SELECT `id`,
                         `menu_id`,
                         `title`
                    FROM `menu_items`
                   WHERE `menu_id`=".$menuId." AND `active`=1
                ORDER BY `ordering`;";

        $this->db->setQuery($query);
        $items = $this->db->getObjectList();

        $currentId = Request::getInt('id');
        foreach ($items as $item) {
            $item->url = $router->getUrl(array('id' => $item->id));
            if ($item->id == $currentId) $item->current = true;
            $item->title = Language::translate($item->title);
        }

        return $items;
    }
}