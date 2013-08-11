<?php

/**
 * Компонент редактирования модулей
 *
 * @project SamCMS
 * @package Modules
 * @author Kash
 * @date 25.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Modules extends Component {

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Main';

    /**
     * Название компонента
     * @var string
     */
    public $name = 'Modules';

    /**
     * Отрисовка html кода
     * @return string|void
     */
    public function render() {

        $this->setSEOParams();

        $controller = $this->getController($this->defaultController);
        if (!$controller)
            Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));

        return $controller->execute();
    }
}