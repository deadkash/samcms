<?php

/**
 * Контроллер разавторизации
 *
 * @project SamCMS
 * @package Auth
 * @author kash
 * @date 23.09.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class AuthControllerLogout extends Controller {

    /**
     * Конструктор
     */
    public function __construct() {
        $this->auth = new Access();
    }

    /**
     * Метод, запускающий контроллер
     * @return string
     */
    public function execute() {

        $this->auth->setUserLogOut();
        Router::redirect('/admin/');
        return '';
    }
}