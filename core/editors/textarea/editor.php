<?php

/**
 * Поле многострочного текста
 *
 * @project SamCMS
 * @package Editor
 * @author Kash
 * @date 26.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class TextareaEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/textarea/template.twig';

    /**
     * Данные для шаблонизатора
     * @var array
     */
    protected $data = array();

    /**
     * Возвращает html код редактора
     *
     * @param string $param
     * @return string
     */
    public function render($param) {
        return parent::render($param);
    }
}