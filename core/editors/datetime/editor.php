<?php

/**
 * Редактор даты и времени
 *
 * @author Kash
 * @project SamCMS
 * @package Editor
 * @date 26.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class DatetimeEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/datetime/template.twig';

    /**
     * Данные для шаблонизатора
     * @var array
     */
    protected $data = array();

    /**
     * Возвращает html код редактора
     *
     * @param $param mixed
     * @return string
     */
    public function render($param) {

        $document = Document::get();
        $document->addJS('/lib/bootstrap-timepicker/bootstrap-timepicker.min.js');
        $document->addCSS('/lib/bootstrap-timepicker/bootstrap-timepicker.css');
        $document->addCSS('/lib/bootstrap-datepicker/datepicker.css');
        $document->addJS('/lib/bootstrap-datepicker/bootstrap-datepicker.js');

        if (strpos($param->default, ' ')) {
            list($date, $time) = explode(' ', $param->default);
            $param->date = $date;
            $param->time = $time;
        }

        return parent::render($param);
    }
}