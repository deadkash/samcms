<?php
/**
 * Фотогалерея
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 15.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Gallery extends Component {

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Gallery';

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
        $this->setLastModifiedDate();

        $controller = $this->getController($this->defaultController);
        return $controller->execute();
    }
}