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
     *
     * @assert ('2012-09-12 12:34:00') == '12 сентября 2012 г.'
     * @param $datetime
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
     * @param $datetime
     * @return string
     */
    public static function getSitemapDate($datetime) {

        list($date, $time) = explode(' ', $datetime);
        list($hour, $min, $sec) = explode(':', $time);

        return $date.'T'.$hour.':'.$min.date('P');
    }
}