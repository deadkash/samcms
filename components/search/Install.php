<?php

/**
 * Установщик
 *
 * @project SamCMS
 * @package Search
 * @author Kash
 * @date 19.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class SearchInstall extends Install {

    /** @var string Тип */
    protected $type = 'component';

    /** @var string Имя */
    protected $name = 'Search';

    /** @var array Параметры */
    protected $params = array();

    /** @var string Заголовок */
    protected $title = 'search';

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