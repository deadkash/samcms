<?php

/**
 * Класс для получения GET и POST параметров
 *
 * @project SamCMS
 * @author Kash
 * @package core
 * @date 29.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Request extends Core {

    /**
     * Возвращает целый параметр, полученный через GET или POST
     *
     * @static
     * @param $name
     * @param $default
     * @return bool|int
     */
    public static function getInt($name, $default = 0) {

        if (isset($_GET[$name])) {
            return (int) $_GET[$name];
        }
        else if (isset($_POST[$name])) {
            return (int) $_POST[$name];
        }
        else return $default;
    }

    /**
     * Возвращает строковое значение, полученное через GET или POST
     *
     * @static
     * @param $name
     * @param $default
     * @return bool
     */
    public static function getStr($name, $default = '') {

        $output = $default;
        if (isset($_GET[$name])) {
            $output = $_GET[$name];
        }
        else if (isset($_POST[$name])) {
            $output = $_POST[$name];
        }

        return $output;
    }

    /**
     * Устанавливает значение в массиве GET
     *
     * @static
     * @param $name
     * @param $value
     */
    public static function setGet($name, $value) {
        $_GET[$name] = $value;
    }

    /**
     * Устанавливает значение в массиве POST
     *
     * @static
     * @param $name
     * @param $value
     */
    public static function setPost($name ,$value) {
        $_POST[$name] = $value;
    }

    /**
     * Возвращает значение переменной $name из массива $_POST
     *
     * @static
     * @param $name
     * @param bool $default
     * @return bool
     */
    public static function getPostStr($name, $default = false) {
        if (isset($_POST[$name])) {
            return $_POST[$name];
        }
        else return $default;
    }

    /**
     * Возвращает значение переменной из массива $_GET
     *
     * @static
     * @param $name
     * @param bool $default
     * @return bool
     */
    public static function getGetStr($name, $default = false) {
        if (isset($_GET[$name])) {
            return $_GET[$name];
        }
        else return $default;
    }

    /**
     * Возвращает файл
     *
     * @param $name
     * @param bool $default
     * @return bool
     */
    public static function getFile($name, $default = false) {

        if (isset($_FILES[$name])) {
            return $_FILES[$name];
        }
        else return $default;
    }
}
