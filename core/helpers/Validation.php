<?php

/**
 * Класс валидации данных
 *
 * @project SamCMS
 * @package helpers
 * @author Kash
 * @date 07.10.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class ValidationHelper {

    /**
     * Проверяет правильность ввода электронной почты. Возвращает false если адрес неверный или правильный адрес.
     *
     * @assert ('deadkash@gmail.com') == 'deadkash@gmail.com'
     * @assert ('test.test.ru') == false
     * @assert ('test@test') == false
     * @assert ('тест@тест.ру') == false
     *
     * @param $email
     * @return mixed
     */
    public static function checkEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Проверка на латиницу и цифры
     * @param $value
     * @return int
     */
    public static function checkLogin($value) {
        return preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $value);
    }

    /**
     * Проверка на целые числа
     * @param $value
     * @return bool
     */
    public static function checkInteger($value) {
        return is_numeric($value);
    }
}
