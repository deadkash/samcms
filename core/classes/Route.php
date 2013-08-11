<?php

/**
 * Интерфейс для роутера модуля
 *
 * @package class
 * @project SamCMS
 * @author Kash
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
abstract class Route {

    /**
     * Возвращает ЧПУ строку адреса
     *
     * @param $params array
     * @return string
     */
    public static function rewriteParams($params) {}

    /**
     * Восстанавливает параметры из ЧПУ
     *
     * @param $params array
     * @return void
     */
    public static function recoverParams($params) {}
}