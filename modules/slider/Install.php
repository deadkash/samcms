<?php

/**
 * Установщик
 *
 * @project SamCMS
 * @package Slider
 * @author Kash
 * @date 19.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class SliderInstall extends Install {

    /** @var string Тип */
    protected $type = 'module';

    /** @var string Имя */
    protected $name = 'Slider';

    /** @var array Параметры */
    protected $params = array(
        0 => array(
            'name' => 'session_id',
            'title' => 'gallery_session',
            'type' => 'gallery',
            'default' => ''
        )
    );

    /** @var string Заголовок */
    protected $title = 'slider';

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