<?php

/**
 * Прототип компонента
 *
 * @project SamCMS
 * @author Kash
 * @package class
 * @date 24.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

abstract class Component {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath;

    /**
     * Данные шаблонизатора
     * @var array
     */
    protected $data;

    /**
     * Раздел, в котором запущен данный компонент
     * @var int
     */
    public $itemId;

    /**
     * Метка, в которой запущен данный компонент
     * @var string
     */
    public $label;

    /**
     * Название компонента
     * @var string
     */
    public $name;

    /**
     * Класс сео
     * @var Seo
     */
    protected $seo;

    /**
     * Класс роутера
     * @var Router
     */
    public $router;

    /**
     * Конструктор
     */
    public function __construct() {
        $this->seo = Seo::create();
        $this->router = Router::create();
    }

    /**
     * Отрисовка шаблонов
     * @return string
     */
    public function render() {
        $this->setSEOParams();
        return Templater::render('components', $this->tplPath, $this->data);
    }

    /**
     * Возвращает контроллер по имени
     * @param $controllerNeed
     * @return mixed
     */
    public function getController($controllerNeed) {

        $controllerName = $this->name.'Controller'.ucfirst($controllerNeed);

        if (class_exists($controllerName)) {

            $controller = new $controllerName();
            $controller->component = $this->name;
            $controller->itemId = $this->itemId;

            return $controller;
        }

        return false;
    }

    /**
     * Магический метод, который вызывается при попытке использовать класс как строку
     * @return string
     */
    public function __toString() {
        return $this->render();
    }

    /**
     * Устанавливает сео-параметры
     * @return void
     */
    public function setSEOParams() {

        $document = Document::get();

        $parameters = Parameters::getSectionParameters($this->itemId);
        if (isset($parameters['title']) && !empty($parameters['title'])) {
            $document->setTitle($parameters['title']);
        }
        if (isset($parameters['description'])) {
            $document->setDescription($parameters['description']);
        }
        if (isset($parameters['keywords'])) {
            $document->setKeywords($parameters['keywords']);
        }
    }

    /**
     * Устанавливает дату модификации
     * @return void
     */
    public function setLastModifiedDate() {

        $params = Parameters::getItemParameters($this->itemId);
        if (isset($params->modified)) {
            $document = Document::get();
            $lastModifiedDate = strtotime($params->modified);
            $document->setLastModifiedDate(gmdate('D, d M Y H:i:s', $lastModifiedDate).' GMT');
        }
    }
}
