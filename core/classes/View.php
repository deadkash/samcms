<?php

/**
 * Заготовка для класса представления модуля
 *
 * @project SamCMS
 * @package class
 * @author kash
 * @date 23.09.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

abstract class View {

    /**
     * Текущий раздел, в котором запущен модуль
     * @var int
     */
    public $itemId;

    /**
     * Текущий модуль
     * @var string
     */
    public $component;

    /**
     * Класс роутера
     * @var Router
     */
    protected $router;

    /**
     * Имя класса
     * @var string
     */
    protected $name;

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = '';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Модель
     * @var mixed
     */
    protected $model;

    /**
     * Конструктор
     */
    public function __construct($viewName) {
        $this->router = Router::create();
        $this->name = $viewName;
    }

    /**
     * Отрисовка шаблона
     * @return string
     */
    protected function render() {
        return Templater::render('components', $this->tplPath, $this->data);
    }

    /**
     * Возвращает модель по имени
     * @param $modelNeed
     * @return mixed
     */
    protected function getModel($modelNeed) {

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
     * Возвращает путь к шаблону
     * @param $templateName
     * @return string
     */
    protected function getTemplatePath($templateName) {
        return strtolower($this->component).'/views/'.strtolower($this->name).'/templates/'.$templateName;
    }

    /**
     * Устанавливает путь к шаблону
     * @param $templateName
     */
    protected function setTemplate($templateName) {
        $this->tplPath = $this->getTemplatePath($templateName);
    }

    /**
     * Устанавливает переменную шаблона
     * @param $name
     * @param $value
     */
    protected function setValue($name, $value) {
        $this->data[$name] = $value;
    }

    /**
     * Устанавливает модель
     * @param $modelName
     */
    protected function setModel($modelName) {
        $this->model = $this->getModel($modelName);
    }
}