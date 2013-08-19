<?php

/**
 * Установщик
 *
 * @project SamCMS
 * @package Menu
 * @author Kash
 * @date 19.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MenuInstall extends Install {

    /** @var string Тип */
    protected $type = 'module';

    /** @var string Имя */
    protected $name = 'Menu';

    /** @var array Параметры */
    protected $params = array(
        0 => array(
            'name' => 'menu_id',
            'title' => 'menueditor_menu',
            'type' => 'select',
            'default' => '',
            'options' => 'menu'
        ),
        1 => array(
            'name' => 'template',
            'title' => 'menueditor_template',
            'type' => 'template',
            'default' => '',
            'options' => 'modules/menu/templates/'
        ),
        2 => array(
            'name' => 'open_all',
            'title' => 'menueditor_open_all',
            'type' => 'checkbox',
            'default' => '0'
        )
    );

    /** @var string Заголовок */
    protected $title = 'menueditor_menu';

    /**
     * Конструктор
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Запуск установки
     * @return bool
     */
    public function execute(){
        return true;
    }
}