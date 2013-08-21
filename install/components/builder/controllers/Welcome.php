<?php

/**
 * Контроллер приветствия
 *
 * @project SamCMS
 * @package Install
 * @author Kash
 * @date 21.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class BuilderControllerWelcome extends Controller {

    /**
     * Представление по умолчанию
     * @var string
     */
    private $defaultView = 'Welcome';

    /**
     * Конструктор
     */
    public function __construct() {
    }

    /**
     * Запуск контроллера
     * @return mixed|void
     */
    public function execute() {

        //Загружаем представление
        $view = $this->getView($this->defaultView);
        return $view->display();
    }
}