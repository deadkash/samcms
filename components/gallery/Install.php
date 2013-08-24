<?php

/**
 * Установщик
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 19.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class GalleryInstall extends Install {

    /** @var string Тип */
    protected $type = 'component';

    /** @var string Имя */
    protected $name = 'Gallery';

    /** @var array Параметры */
    protected $params = array(
        0 => array(
            'name' => 'session_id',
            'title' => 'gallery_session',
            'type' => 'gallery',
            'default' => ''
        ),
        1 => array(
            'name' => 'min_name',
            'title' => 'gallery_min_name',
            'type' => 'text',
            'default' => 'min'
        ),
        2 => array(
            'name' => 'max_name',
            'title' => 'gallery_max_name',
            'type' => 'text',
            'default' => 'med'
        )
    );

    /** @var string Заголовок */
    protected $title = 'gallery';

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

        $installation = new Installation();
        $installation->executeSQL(ABS_PATH.'components/gallery/install/install.sql');
        return true;
    }
}