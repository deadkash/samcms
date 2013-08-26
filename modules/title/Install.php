<?php

/**
 * Установщик
 *
 * @project SamCMS
 * @package Title
 * @author Kash
 * @date 19.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class TitleInstall extends Install {

    /** @var string Тип */
    protected $type = 'module';

    /** @var string Имя */
    protected $name = 'Title';

    /** @var array Параметры */
    protected $params = array();

    /** @var string Заголовок */
    protected $title = 'title';

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