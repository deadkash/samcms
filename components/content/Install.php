<?php

/**
 * Установщик
 *
 * @project SamCMS
 * @package Content
 * @author Kash
 * @date 19.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class ContentInstall extends Install {

    /** @var string Тип */
    protected $type = 'component';

    /** @var string Имя */
    protected $name = 'Content';

    /** @var array Параметры */
    protected $params = array(
        0 => array(
            'name' => 'text',
            'title' => 'content_code',
            'type' => 'editor',
            'default' => ''
        )
    );

    /** @var string Заголовок */
    protected $title = 'content';

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