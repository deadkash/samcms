<?php

/**
 * Класс авторизации и управлением пользователями
 *
 * @project SamCMS
 * @author Kash
 * @package core
 * @date 29.07.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Access extends Core {

    /**
     * Минимальная длина пароля
     * @var int
     */
    public $passwordMinLength = 4;

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Проверка доступа к разделу
     * @param $itemId int Раздел
     * @return bool
     */
    public function getAccess($itemId) {

        if (!isset($_SESSION['_user_vars'])) {
            return $this->checkAccess($itemId, Config::$defaultPolicy);
        }
        else {
            if (!isset($_SESSION['_user_vars']['id'])) return false;
            $userID = $_SESSION['_user_vars']['id'];

            $user = $this->getUser($userID);
            if (!isset($user->login) || !$user->login) return false;
            return $this->checkAccess($itemId, $user->policy_id);
        }
    }

    /**
     * Проверяет доступ к разделу группе пользователей
     * @param $itemId int Раздел
     * @param $policyId int Политика доступа
     * @return bool
     */
    public function checkAccess($itemId, $policyId) {

        $itemId = (int) $itemId;
        $policyId = (int) $policyId;

        $output = false;

        $query = "SELECT `id`
                    FROM `users_policy_allow`
                   WHERE `section_id`=".$itemId." AND `policy_id`=".$policyId.";";
        $this->db->setQuery($query);
        $policyAllow = $this->db->getObject();

        $query = "SELECT `id`
                    FROM `users_policy_deny`
                   WHERE `section_id`=".$itemId." AND `policy_id`=".$policyId.";";
        $this->db->setQuery($query);
        $policyDeny = $this->db->getObject();

        //Если ни разрешено, ни запрещено - значит разрешено
        if (!$policyAllow && !$policyDeny) {
            return true;
        }
        //Если разрешено, то разрешено
        else if ($policyAllow && !$policyDeny) {
            return true;
        }
        //Если запрещено, то запрещено
        else if (!$policyAllow && $policyDeny) {
            return false;
        }
        //Если запрещено и разрешено, то запрещено
        else if ($policyAllow && $policyDeny) {
            return false;
        }

        return $output;
    }

    /**
     * Возвращает данные пользователя
     * @param $userID int ID пользователя
     * @return bool|stdClass
     */
    public function getUser($userID) {

        $userID = (int) $userID;
        $query = "SELECT * FROM `users` WHERE `id`=".$userID.";";
        $this->db->setQuery($query);

        $user = $this->db->getObject();

        return $user;
    }

    /**
     * Возвращает текущего авторизованного пользователя
     * @return bool|stdClass
     */
    public function getCurrentUser() {

        if (!isset($_SESSION['_user_vars'])) return false;
        else {
            if (!isset($_SESSION['_user_vars']['id'])) return false;
            $userID = $_SESSION['_user_vars']['id'];

            $user = $this->getUser($userID);
            if (!isset($user->login) || !$user->login) return false;
        }

        return $user;
    }

    /**
     * Проверяет логин и пароль пользователя
     * @param $login string Логин
     * @param $password string Пароль
     * @return bool
     */
    public function checkLogin($login, $password) {

        $login = $this->db->escape($login);
        $password = $this->db->escape($password);
        $password = $this->preparePassword($password, $login);

        $query = "SELECT `password`,
                         `id`
                    FROM `users`
                   WHERE `login`='".$login."' AND `active`=1;";
        $this->db->setQuery($query);
        $user = $this->db->getObject();

        if (!$user) return false;

        if ($user->password === $password) return $user->id;
        else return false;
    }

    /**
     * Возвращает md5 хэш пароля
     * @param $password string Пароль
     * @param $login string Логин
     * @return string
     */
    public function preparePassword($password, $login) {
        return md5($login.'_|_'.$password);
    }

    /**
     * Авторизует пользователя
     * @param $userID int ID пользователя
     * @return bool
     */
    public function setUserLogIn($userID) {

        $userID = (int) $userID;
        $query = "SELECT * FROM `users` WHERE `id`=".$userID.";";
        $this->db->setQuery($query);

        $user = $this->db->getObject();

        if ($user) {

            $_SESSION['_user_vars']['id'] = $user->id;
            $_SESSION['_user_vars']['login'] = $user->login;
            Log::addLogUserLogin($user->id);
            return true;
        }
        else return false;
    }

    /**
     * Разлогинивает текущего пользователя
     * @return void
     */
    public function setUserLogOut() {

        if (isset($_SESSION['_user_vars']['id'])) {
            $userId = $_SESSION['_user_vars']['id'];
            Log::addLogUserLogout($userId);
        }
        unset($_SESSION['_user_vars']);
    }

    /**
     * Проверяет сущестование логина
     * @param $login string Логин
     * @return bool
     */
    public function loginExists($login) {

        $login = $this->db->escape($login);
        $query = "SELECT `id`
                    FROM `users`
                   WHERE `login`='".$login."';";
        $this->db->setQuery($query);
        $user = $this->db->getObject();
        if (isset($user->id)) return $user->id;
        else return false;
    }

    /**
     * Создает нового пользователя
     * @param $user stdClass Пользователь
     * @return bool
     */
    public function createUser($user) {

        $user->active = 0;
        $user->policy_id = Config::$registerPolicy;
        $user->password = $this->preparePassword($user->password, $user->login);
        $user->date = date('Y-m-d H:i:s');

        return $this->db->insert('users', $user);
    }

    /**
     * Проверяет введенные пароли
     * @param $pass1 string Пароль 1
     * @param $pass2 string Пароль 2
     * @return bool
     */
    public function checkPasswords($pass1, $pass2) {
        return $pass1 === $pass2;
    }

    /**
     * Проверяет минимальную длину пароля
     * @param $password string Пароль
     * @return bool
     */
    public function checkPassMinLength($password) {
        return (strlen($password) >= $this->passwordMinLength);
    }

    /**
     * Активирует пользователя
     * @param $userId int ID пользователя
     */
    public function activateUser($userId) {

        $userId = (int) $userId;

        $user = new stdClass();
        $user->id = $userId;
        $user->active = 1;

        $this->db->save('users', $user, 'id');
    }

    /**
     * Проверяет существование e-mail среди зарегистрированных пользователей
     * @param $email string E-mail
     * @return bool
     */
    public function existEmail($email) {

        $email = $this->db->escape($email);
        $query = "SELECT `id`
                    FROM `users`
                   WHERE `email`='".$email."';";
        $this->db->setQuery($query);

        $userId = $this->db->getObject();

        if (isset($userId->id)) return $userId->id;
        else return false;
    }

    /**
     * Изменяет пароль пользователю
     * @param $userId int ID пользователя
     * @param $password string Пароль
     */
    public function changePassword($userId, $password) {

        $userId = (int) $userId;
        $user = $this->getUser($userId);
        $password = $this->preparePassword($password, $user->login);

        $query = "UPDATE `users`
                     SET `password`='".$password."'
                   WHERE `id`=".$userId.";";
        $this->db->query($query);
    }
}