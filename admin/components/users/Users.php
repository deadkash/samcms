<?php

/**
 * Компонент для управления пользователями, политиками и доступами к разделам
 *
 * @project SamCMS
 * @package Users
 * @author Kash
 * @date 1.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Users extends Component {

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Users';

    /**
     * Название компонента
     * @var string
     */
    public $name = 'Users';

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