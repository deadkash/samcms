<?php

/**
 * Формы
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 30.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Forms extends Component {

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Forms';

    /**
     * Название компонента
     * @var string
     */
    public $name = 'Forms';

    /**
     * Запуск контроллера
     * @return mixed|string
     */
    public function render() {

        $this->setSEOParams();

        /** @var $controller Controller */
        $controllerName = Request::getStr('controller', $this->defaultController);
        $controller = $this->getController($controllerName);
        if (!$controller)
            Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));

        return $controller->execute();
    }
}