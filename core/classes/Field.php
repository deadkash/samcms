<?php
/**
 * Заготовка для поля формы
 *
 * @project SamCMS
 * @package Class
 * @author Kash
 * @date 07.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Field {

    /** @var string Название поля */
    public $name;

    /** @var string Заголовок поля */
    public $title;

    /** @var string Тип редактора */
    public $type = 'text';

    /** @var string Тип валидации */
    public $validation;

    /** @var string CSS класс поля */
    public $class;

    /** @var bool Ошибка в поле */
    public $error;

    /** @var string Отрисованный html-код */
    public $html;

    /** @var mixed Фактическое значение поля */
    public $value;

    /** @var string Значение по умолчанию */
    public $default = '';

    /** @var bool Обязательно для заполнения */
    public $required = false;

    /** @var int Высота поля */
    public $height;

    /** @var mixed Набор параметров */
    public $options;

    /** @var integer Размер  */
    public $size;

    /**
     * Устанавливает css класс
     * @param string $class
     * @return Field
     */
    public function setClass($class) {
        $this->class = $class;
        return $this;
    }

    /**
     * Устанавливает значение по умолчанию
     * @param string $default
     * @return Field
     */
    public function setDefault($default) {
        $this->default = Request::getStr($this->name, $default);
        $this->value = $this->default;
        return $this;
    }

    /**
     * Устанавливает название поля
     * @param string $name
     * @return Field
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Устанавливает заголовок поля
     * @param string $title
     * @return Field
     */
    public function setTitle($title) {
        $this->title = Language::translate($title);
        return $this;
    }

    /**
     * Устанавливает тип редактора
     * @param string $type
     * @return Field
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * Устанавливает тип валидации
     * @param $validation
     * @return $this
     */
    public function setValidation($validation){
        $this->validation = $validation;
        return $this;
    }

    /**
     * Устанавливает обязательный
     * @param $required bool
     * @return $this Field
     */
    public function setRequired($required){
        $this->required = $required;
        return $this;
    }

    /**
     * Устанавливает высоту поля
     * @param $height
     * @return $this
     */
    public function setHeight($height){
        $this->height = $height;
        return $this;
    }

    /**
     * Отрисовка html
     * @return Field
     */
    public function setHtml() {
        $this->html = Fields::getField($this);
        $this->error = Messages::issetError($this->name.'_error');
        return $this;
    }

    /**
     * Установка параметров
     * @param $options
     * @return $this
     */
    public function setOptions($options){
        $this->options = $options;
        return $this;
    }

    /**
     * Установка размера
     * @param $size
     * @return $this
     */
    public function setSize($size){
        $this->size = $size;
        return $this;
    }
    
}