<?php

/**
 * Установщик
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 19.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsInstall extends Install {

    /** @var string Тип */
    protected $type = 'component';

    /** @var string Имя */
    protected $name = 'Materials';

    /** @var array Параметры */
    protected $params = array(
        0 => array(
            'name' => 'category_id',
            'title' => 'materials_cat',
            'type' => 'category',
            'default' => ''
        ),
        1 => array(
            'name' => 'count',
            'title' => 'materials_count_page',
            'type' => 'text',
            'default' => '10'
        ),
        2 => array(
            'name' => 'template_list',
            'title' => 'materials_template_list',
            'type' => 'template',
            'default' => 'list.twig',
            'options' => 'components/materials/views/list/templates/'
        ),
        3 => array(
            'name' => 'template_detail',
            'title' => 'materials_template_detail',
            'type' => 'template',
            'default' => 'detail.twig',
            'options' => 'components/materials/views/detail/templates/'
        )
    );

    /** @var string Заголовок */
    protected $title = 'materials';

    /** @var string Псевдоним для разделы в админке */
    protected $alias = 'materials';

    /**
     * Запуск установки
     * @return bool
     */
    public function execute(){

        $installation = Installation::create();
        $installation->executeSQL(ABS_PATH.'components/materials/install/install.sql');
        $installation->setupAdminComponent($this->name, $this->title, $this->alias);
        return true;
    }
}