<?php
/**
 * Контроллер карты сайта
 *
 * @project SamCMS
 * @package 
 * @author Kash
 * @date 27.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class SitemapControllerSitemap extends Controller {

    /**
     * Представление по умолчанию
     * @var string
     */
    private $defaultView = 'Sitemap';

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Запуск контроллера
     * @return mixed|void
     */
    public function execute() {

        //Загружаем представление
        $view = $this->getView(Request::getStr('view',$this->defaultView));
        if (!$view) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section'))));

        return $view->display();
    }
}