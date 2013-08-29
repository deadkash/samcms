<?php

/**
 * Заготовка для контроллера компонента
 *
 * @project SamCMS
 * @package class
 * @author kash
 * @date 23.09.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

abstract class Controller {

    /**
     * Текущий раздел
     * @var int
     */
    public $itemId;

    /**
     * Текущий компонент
     * @var string
     */
    public $component;

    /**
     * Класс роутера
     * @var Router
     */
    public $router;

    /**
     * Модель
     * @var mixed
     */
    public $model;

    /**
     * Конструктор
     */
    public function __construct() {
        $this->router = Router::create();
    }

    /**
     * Обязательный методы, который запускает контроллер
     * @return mixed
     */
    abstract public function execute();

    /**
     * Возвращает представление по имени
     * @param $viewNeed
     * @return mixed
     */
    public function getView($viewNeed) {

        $viewName = $this->component.'View'.ucfirst($viewNeed);

        if (class_exists($viewName)) {

            $view = new $viewName($viewNeed);
            $view->itemId = $this->itemId;
            $view->component = $this->component;

            return $view;
        }

        return false;
    }

    /**
     * Возвращает модель по имени
     * @param $modelNeed
     * @return mixed
     */
    public function getModel($modelNeed) {

        $modelName = $this->component.'Model'.ucfirst($modelNeed);

        if (class_exists($modelName)) {

            $model = new $modelName;
            $model->itemId = $this->itemId;
            $model->component = $this->component;

            return $model;
        }

        return false;
    }

    /**
     * Устанавливает модель
     * @param $modelName
     */
    public function setModel($modelName) {
        $this->model = $this->getModel($modelName);
    }
}
