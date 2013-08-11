<?php

/**
 * Класс для добавления системных сообщений
 *
 * @project SamCMS
 * @author Kash
 * @package core
 * @date 22.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Messages extends Core {

    /**
     * Добавление сообщения
     * @param $type
     * @param $text
     * @param $name
     * @return void
     */
    public static function addMessage($name, $type, $text) {

        $_SESSION['messages'][$name] = array(
            'type' => $type,
            'text' => $text
        );
    }

    /**
     * Добавляет ошибку
     * @param $name
     * @param $type
     */
    public static function addError($name, $type) {
        $_SESSION['errors'][$name] = $type;
    }

    /**
     * Удаление всех сообщений
     * @return void
     */
    public static function clearAll() {
        $_SESSION['messages'] = array();
        $_SESSION['errors'] = array();
    }

    /**
     * Возвращает массив сообщений
     * @return array
     */
    public static function getMessages() {
        $_SESSION['errors'] = array();
        if (isset($_SESSION['messages'])) return $_SESSION['messages'];
        else return false;
    }

    /**
     * Существование сообщение
     * @param $name
     * @return bool
     */
    public static function issetMessage($name) {
        return isset($_SESSION['messages'][$name]);
    }

    /**
     * Существование ошибки
     * @param $name
     * @return bool
     */
    public static function issetError($name) {
        return isset($_SESSION['errors'][$name]);
    }
}