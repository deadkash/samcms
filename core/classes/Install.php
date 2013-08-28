<?php

/**
 * Прототип файла установки компонента или модуля
 *
 * @project SamCMS
 * @package Class
 * @author Kash
 * @since 0.2.4
 * @date 17.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

abstract class Install {

    /** @var DB класс для работы с базой данных */
    protected $db;

    /** @var string Модуль или компонент */
    protected $type = null;

    /** @var string Имя компонента или модуля */
    protected $name = null;

    /** @var array Параметры */
    protected $params = null;

    /** @var string Название компонента или модуля */
    protected $title = null;

    /** @var bool Флаг регистрации компонента */
    public $registerMe = true;

    /** @var string Псевдоним для разделы в админке */
    protected $alias = null;

    /**
     * Конструктор
     */
    public function __construct(){
        $this->db = DB::create();
    }

    /**
     * Запуск установки
     * @return bool
     */
    public function execute() {
        return true;
    }

    /**
     * Возвращает тип элемента
     * @return null|string
     */
    public function getType(){
        return $this->type;
    }

    /**
     * Возвращает имя элемента
     * @return null|string
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Возвращает параметры
     * @return array|null
     */
    public function getParams(){
        return $this->params;
    }

    /**
     * Возвращает заголовок
     * @return null|string
     */
    public function getTitle(){
        return $this->title;
    }
}