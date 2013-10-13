<?php

/**
 * Чехбокс
 *
 * @author Kash
 * @project SamCMS
 * @package Editor
 * @date 23.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class CheckboxEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/checkbox/template.twig';

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