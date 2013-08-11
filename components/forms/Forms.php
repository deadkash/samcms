<?php
/**
 * Редактор форм
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 08.06.13
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

        /** @var $controller Controller */
        $controller = $this->getController($this->defaultController);
        $this->setSEOParams();
        $this->setLastModifiedDate();

        return $controller->execute();
    }
}