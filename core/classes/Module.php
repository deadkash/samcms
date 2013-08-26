<?php

/**
 * Прототип для файла модуля
 *
 * @project SamCMS
 * @author Kash
 * @package class
 * @date 29.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

abstract class Module {

    /**
     * Путь к шаблону
     * @var string
     */
    protected  $tplPath;

    /**
     * Данные шаблонизатора
     * @var array
     */
    protected $data;

    /**
     * Раздел, в котором запущен данный модуль
     * @var int
     */
    public $itemId;

    /**
     * Метка, в которой запущен данный модуль
     * @var string
     */
    public $label;

    /**
     * Название модуля
     * @var string
     */
    public $name;

    /**
     * Время кэширования в секундах
     * @var int
     */
    protected $cacheTime = 120;

    /**
     * Отрисовка шаблонов
     * @return string
     */
    public function render() {

        $html = Templater::render('modules', $this->tplPath, $this->data);
        Cache::set($html, $this);

        return $html;
    }

    /**
     * Магический метод, который вызывается при попытке использовать класс как строку
     * @return string
     */
    public function __toString() {
        return $this->render();
    }
}