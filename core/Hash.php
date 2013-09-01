<?php

/**
 * Класс для создания хэш ключей
 *
 * @project SamCMS
 * @package core
 * @author Kash
 * @date 06.10.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Hash extends Core {

    /**
     * Конструктор
     */
    public function construct() {
        parent::__construct();
    }

    /**
     * Создает новый ключ
     * @param $uid string Уникальный идентификатор
     * @param $interval int Количество дней
     * @return string
     */
    public function createKey($uid, $interval) {

        $uid = $this->db->escape($uid);
        $interval = (int) $interval;
        $hash = md5($uid.md5(time().rand(0, 1000)));

        $query = "INSERT INTO `hash_keys` (`hash`,`uid`,`expire_date`)
                       VALUES ('$hash', '$uid', NOW() + INTERVAL $interval DAY);";
        $this->db->query($query);

        //Пользуясь случаем удаляем истекшие ключи
        $this->delExpired();

        return $hash;
    }

    /**
     * Возвращает уникальный идентификатор по ключу
     * @param $hash string Хэш
     * @return bool|stdClass
     */
    public function getIdByHash($hash) {

        $hash = $this->db->escape($hash);
        $query = "SELECT `uid`
                    FROM `hash_keys`
                   WHERE `hash`='".$hash."';";
        $this->db->setQuery($query);
        $uid = $this->db->getObject();

        if (!isset($uid->uid)) return false;

        return $uid->uid;
    }

    /**
     * Удаляет хэш
     * @param $hash string Хэш
     */
    public function delHash($hash) {

        $hash = $this->db->escape($hash);
        $this->db->delete('hash_keys', 'hash', $hash);

        $this->delExpired();
    }

    /**
     * Удаляет истекшие ключи
     * @return void
     */
    private function delExpired() {

        $query = "DELETE FROM `hash_keys` WHERE `expire_date` < NOW();";
        $this->db->query($query);
    }
}