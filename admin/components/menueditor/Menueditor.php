<?php

/**
 * Модуль редактирования меню
 *
 * @project SamCMS
 * @author Kash
 * @package MenuEditor
 * @date 30.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Menueditor extends Component {

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Main';

    /**
     * Название модуля
     * @var string
     */
    public $name = 'Menueditor';

    /**
     * Запуск контроллеров
     * @return mixed|string
     */
    public function render() {

        $this->setSEOParams();

        /** @var $controller Controller */
        $controller = $this->getController($this->defaultController);
        if (!$controller)
            Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));

        return $controller->execute();
    }
}