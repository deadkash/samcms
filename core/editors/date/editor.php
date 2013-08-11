<?php

/**
 * Редактор даты
 *
 * @author Kash
 * @project SamCMS
 * @package Editor
 * @date 26.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class DateEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/date/template.twig';

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

        $document = Document::get();
        $document->addCSS('/lib/bootstrap-datepicker/datepicker.css');
        $document->addJS('/lib/bootstrap-datepicker/bootstrap-datepicker.js');

        return parent::render($param);
    }
}