<?php

/**
 * Построитель CMS
 *
 * @project SamCMS
 * @package Install
 * @author Kash
 * @date 21.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Builder extends Component {

    /**
     * Конструктор
     */
    public function __construct(){}

    /**
     * Контроллер по умолчанию
     * @var string
     */
    private $defaultController = 'Main';

    /**
     * Название компонента
     * @var string
     */
    public $name = 'Builder';

    /**
     * Запуск контроллера
     * @return mixed|string
     */
    public function render() {

        $controller = $this->getController($this->defaultController);
        return $controller->execute();
    }
}