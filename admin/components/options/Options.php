<?php

/**
 * Класс редактирования настроек сайта
 *
 * @project SamCMS
 * @package Options
 * @author Kash
 * @date 1.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Options extends Component {

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Main';

    /**
     * Название компонента
     * @var string
     */
    public $name = 'Options';

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