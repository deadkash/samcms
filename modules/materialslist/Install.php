<?php

/**
 * Установщик
 *
 * @project SamCMS
 * @package Materialslist
 * @author Kash
 * @date 19.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialslistInstall extends Install {

    /** @var string Тип */
    protected $type = 'module';

    /** @var string Имя */
    protected $name = 'Materialslist';

    /** @var array Параметры */
    protected $params = array(
        0 => array(
            'name' => 'category_id',
            'title' => 'materials_cat',
            'type' => 'category',
            'default' => ''
        ),
        1 => array(
            'name' => 'template',
            'title' => 'materials_template',
            'type' => 'template',
            'default' => '',
            'options' => 'modules/materialslist/templates/'
        ),
        2 => array(
            'name' => 'count',
            'title' => 'materials_count',
            'type' => 'text',
            'default' => '3'
        ),
        3 => array(
            'name' => 'title',
            'title' => 'materials_title',
            'type' => 'text',
            'default' => ''
        )
    );

    /** @var string Заголовок */
    protected $title = 'materials_category';

    /**
     * Констуктор
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