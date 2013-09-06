<?php

/**
 * Кэширование
 *
 * @project SamCMS
 * @package core
 * @author Kash
 * @date 10.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Cache extends Core {

    /**
     * Путь к кэшу
     * @var string
     */
    private static $cachePath = 'cache/html/';

    /**
     * Установка кэша модуля
     * @param $html string Отрисованный код модуля
     * @param $module mixed Объект модуля
     * @return int
     */
    public static function set($html, $module) {
        $name = self::getName($module);
        return @file_put_contents($name, $html);
    }

    /**
     * Возвращает кэш модуля
     * @param $module mixed Объект модуля
     * @param $time int Актуальное время кэша
     * @return bool|string
     */
    public static function get($module, $time) {

        $name = self::getName($module);

        if (!file_exists($name)) return false;
        $timestamp = filemtime($name);

        if ((time() - $timestamp) > $time) return false;
        else return @file_get_contents($name);
    }

    /**
     * Генерация имени для кэша
     * @param $module mixed Объект модуля
     * @return string
     */
    private static function getName($module) {
        return ABS_PATH.self::$cachePath.md5($module->name.$module->label.$module->itemId).'.html';
    }

    /**
     * Обнуление кэша
     * @return void
     */
    public static function invalidate() {
        $list = scandir(ABS_PATH.self::$cachePath);
        foreach ($list as $file) {
            if (strpos($file, '.html')) {
                unlink(ABS_PATH.self::$cachePath.$file);
            }
        }
    }
}