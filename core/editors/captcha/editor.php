<?php

/**
 * Редактор captcha
 *
 * @author Kash
 * @project SamCMS
 * @pachage Editor
 * @date 04.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class CaptchaEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/captcha/template.twig';

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