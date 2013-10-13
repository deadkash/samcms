<?php

/**
 * Модуль вставки html кода
 *
 * @project SamCMS
 * @package Content
 * @author Kash
 * @date 23.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Content extends Component {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'content/template.twig';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Имя модуля
     * @var string
     */
    public $name = 'Content';

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Отрисовка html кода
     * @return string
     */
    public function render() {

        $this->data = Parameters::getComponentParameters($this->name, $this->itemId);
        $this->setLastModifiedDate();
        return parent::render($this->tplPath, $this->data);
    }
}