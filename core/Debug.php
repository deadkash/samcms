<?php

/**
 * Хранение отладочных переменных, запись переменных в файл
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

    /**
     * Записывает указанные переменные в файл
     * @return void
     */
    public static function dump() {

        $args = func_get_args();
        $fileResource = fopen(ROOT_PATH.'dump.log', 'a');

        foreach ($args as $arg) {

            $data = "[".date('Y-m-d H:i:s')." ](".gettype($arg)."): ".print_r($arg, true)."\r\n";
            fwrite($fileResource, $data);
        }
        fwrite($fileResource, "---------------------------------------------\r\n");
        fclose($fileResource);
    }
}