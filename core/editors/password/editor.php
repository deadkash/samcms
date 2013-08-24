<?php

/**
 * Редактор input type=password
 *
 * @author Kash
 * @project SamCMS
 * @pachage Editor
 * @date 24.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class PasswordEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/password/template.twig';

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