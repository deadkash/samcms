<?php
/**
 * Контроллер результатов поиска
 *
 * @project SamCMS
 * @package Search
 * @author Kash
 * @date 13.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class SearchControllerMain extends Controller {

    /**
     * Представление по умолчанию
     * @var string
     */
    private $defaultView = 'Result';

    /**
     * Конструктор
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Запуск контроллера
     * @return mixed
     */
    public function execute(){

        $view = $this->getView($this->defaultView);
        if (!$view) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section'))));

        return $view->display();
    }
}