<?php

/**
 * Установщик
 *
 * @project SamCMS
 * @package Sitemap
 * @author Kash
 * @date 19.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class SitemapInstall extends Install {

    /** @var string Тип */
    protected $type = 'component';

    /** @var string Имя */
    protected $name = 'Sitemap';

    /** @var array Параметры */
    protected $params = array();

    /** @var string Заголовок */
    protected $title = 'sitemap';

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