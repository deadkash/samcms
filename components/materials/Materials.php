<?php

/**
 * Материалы
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 26.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Materials extends Component {

    /**
     * Имя модуля
     * @var string
     */
    public $name = 'Materials';

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Main';

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Отрисовка html кода
     * @return string
     */
    public function render() {

        /** @var $controller Controller */
        $controllerName = Request::getStr('controller', $this->defaultController);
        $controller = $this->getController($controllerName);
        if (!$controller) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section'))));

        return $controller->execute();
    }
}
