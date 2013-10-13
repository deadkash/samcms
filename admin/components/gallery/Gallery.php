<?php
/**
 * Компонент фотогалереи
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 09.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Gallery extends Component {

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Session';

    /**
     * Название компонента
     * @var string
     */
    public $name = 'Gallery';

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