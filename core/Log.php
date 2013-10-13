<?php

/**
 * Класс логирования событий системы
 *
 * @project SamCMS
 * @package core
 * @author Kash
 * @date 21.10.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Log extends Core {

    /**
     * Записывает событие входа пользователя в журнал
     * @param $userId
     * @return void
     */
    public static function addLogUserLogin($userId) {

        $db = DB::create();
        $userId = (int) $userId;

        $query = "INSERT INTO `log` (`event`,`user_id`,`date`,`ip`,`agent`)
                       VALUES ('login',$userId,NOW(),'".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."');";
        $db->query($query);
    }

    /**
     * Записывает событие выхода пользователя в журнал
     * @param $userId
     * @return void
     */
    public static function addLogUserLogout($userId) {

        $db = DB::create();
        $userId = (int) $userId;

        $query = "INSERT INTO `log` (`event`,`user_id`,`date`,`ip`,`agent`)
                       VALUES ('logout',$userId,NOW(),'".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."');";
        $db->query($query);
    }
}