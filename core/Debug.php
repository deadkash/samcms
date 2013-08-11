<?php

/**
 * Класс, хранящий переменные для отладки
 *
 * @project SamCMS
 * @author Kash
 * @package core
 * @date 28.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Debug {

    /**
     * Массив запросов
     * @var array
     */
    public static $queries;

    /**
     * Массив ошибок mysql
     * @var array
     */
    public static $mysqlErrors;

}