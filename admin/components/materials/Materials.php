<?php

/**
 * Компонент управления материалами
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 23.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Materials extends Component {

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Categories';

    /**
     * Название компонента
     * @var string
     */
    public $name = 'Materials';

    /**
     * Запуск контроллера
     * @return mixed|string
     */
    public function render() {

        $this->setSEOParams();

        /** @var $controller Controller */
        $controllerName = Request::getStr('controller', $this->defaultController);
        $controller = $this->getController($controllerName);
        if (!$controller) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));

        return $controller->execute();
    }
}