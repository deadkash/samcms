<?php

/**
 * Контроллер авторизации
 *
 * @project SamCMS
 * @package Auth
 * @author kash
 * @date 23.09.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class AuthControllerLogin extends Controller {

    /**
     * Класс представления
     * @var AuthViewLogin
     */
    private $view;

    /**
     * Конструктор
     */
    public function __construct() {

        $this->view = new AuthViewLogin();
        $this->auth = new Access();
    }

    /**
     * Метод, запускающий контроллер
     * @return mixed
     */
    public function execute() {

        $userID = false;
        $result = false;

        $action = Request::getStr('action');
        if ($action == 'login') {

            $login = Request::getStr('login');
            $password = Request::getStr('password');
            $userID = $this->auth->checkLogin($login, $password);
            $result = 'error';
        }

        if (!$userID) {
            return $this->view->display($result);
        }
        else {

            $this->auth->setUserLogIn($userID);
            Router::redirect('/admin/');
            return '';
        }
    }
}