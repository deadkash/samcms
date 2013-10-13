<?php

/**
 * Модель пользователей
 *
 * @project SamCMS
 * @package Users
 * @author Kash
 * @date 30.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class UsersModelUser extends Model {

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает пользователей
     * @return array|bool
     */
    public function getUsers() {

        $query = "SELECT `u`.`id`,
                         `u`.`login`,
                         `u`.`active`,
                         `u`.`policy_id`,
                         `u`.`email`,
                         `u`.`date`,
                         `up`.`name` AS `policy_title`
                    FROM `users` AS `u`
               LEFT JOIN `users_policy` AS `up`
                      ON `u`.`policy_id`=`up`.`id`
                ORDER BY `u`.`id`;";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Валидация данных пользователя
     * @param $user
     * @param $checkPass
     * @return bool
     */
    public function validateUser($user, $checkPass = true) {

        $valid = true;
        $auth = new Access();

        //E-mail пустой
        if (empty($user->email)) {
            $valid = false;
            Messages::addMessage('email_error', 'alert-danger', Language::translate('users_msg_empty_email'));
        }

        //E-mail не валидный
        if (!empty($user->email) && !ValidationHelper::checkEmail($user->email)) {
            $valid = false;
            Messages::addMessage('email_error', 'alert-danger', Language::translate('users_msg_invalid_email'));
        }

        //E-mail уже существует
        $emailUserId = $auth->existEmail($user->email);
        $emailExists = $emailUserId;
        if (isset($user->id)) $emailExists = ($emailUserId != $user->id);
        if ($emailExists) {
            $valid = false;
            Messages::addMessage('email_error', 'alert-danger', Language::translate('users_msg_exists_email'));
        }

        //Если проверяем пароли
        if ($checkPass) {
            //Пароль пустой
            if (empty($user->password) || empty($user->password_confirmed)) {
                $valid = false;
                Messages::addMessage('password_error', 'alert-danger', Language::translate('users_msg_empty_password'));
            }

            //Пароли не совпадают
            if (!$auth->checkPasswords($user->password, $user->password_confirmed)) {
                $valid = false;
                Messages::addMessage('password_error', 'alert-danger', Language::translate('users_msg_invalid_password'));
            }

            //Пароль короткий
            if (!$auth->checkPassMinLength($user->password)) {
                $valid = false;
                Messages::addMessage('password_error', 'alert-danger', Language::translate('users_msg_short_password'));
            }
        }

        //Группа не выбрана
        if (empty($user->policy_id)) {
            $valid = false;
            Messages::addMessage('policy_error', 'alert-danger', Language::translate('users_msg_empty_policy'));
        }

        return $valid;
    }

    /**
     * Добавляет пользователя
     * @param $user
     * @return mixed
     */
    public function addUser($user) {

        $auth = new Access();
        unset($user->password_confirmed);
        $user->password = $auth->preparePassword($user->password, $user->login);
        $user->date = date('Y-m-d H:i:s');

        return $this->db->insert('users', $user);
    }

    /**
     * Обновляет пользователя
     * @param $user
     * @param $savePass
     * @return bool
     */
    public function updUser($user, $savePass){

        $dbUser = $this->getUserById($user->id);

        //Если меняем пароль
        if ($savePass) {
            $auth = new Access();
            $user->password = $auth->preparePassword($user->password, $dbUser->login);
        }
        else {
            unset($user->password);
        }

        unset($user->password_confirmed);

        return $this->db->save('users', $user, 'id');
    }

    /**
     * Удаляет пользователей
     * @param $users
     * @return bool
     */
    public function deleteUsers($users){

        $auth = new Access();
        $currentUser = $auth->getCurrentUser();
        foreach ($users as $key => $userId) {

            //Чтобы нельзя было удалить самого себя
            if ($userId == $currentUser->id) unset($users[$key]);
        }

        return $this->db->delete('users', 'id', $users, 'list');
    }

    /**
     * Возвращает пользователя по id
     * @param $userId
     * @return bool|stdClass
     */
    public function getUserById($userId){

        $userId = (int) $userId;
        $query = "SELECT `id`,
                         `login`,
                         `active`,
                         `policy_id`,
                         `date`,
                         `email`
                    FROM `users`
                   WHERE `id`=".$userId.";";
        $this->db->setQuery($query);

        return $this->db->getObject();
    }
}