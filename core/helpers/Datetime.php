<?php

/**
 * Помощник для дат
 *
 * @project SamCMS
 * @package helper
 * @author Kash
 * @date 07.10.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class DatetimeHelper {

    /**
     * Подготавливает дату
     * @param $datetime string Дата и время
     * @return string
     */
    public static function prepareDate($datetime) {

        $time = strtotime($datetime);
        $date = date('Y.m.d', $time);
        list($year, $month, $day) = explode('.', $date);
        $month = Language::translate('core_month'.$month);

        return $day.' '.$month.' '.$year;
    }

    /**
     * Возвращает дату для карты сайта
     * @param $datetime string Дата и время
     * @return string
     */
    public static function getSitemapDate($datetime) {

        list($date, $time) = explode(' ', $datetime);
        list($hour, $min, $sec) = explode(':', $time);

        return $date.'T'.$hour.':'.$min.date('P');
    }
}