<?php

/**
 * Контроллер активации аккаунта
 *
 * @project SamCMS
 * @package Auth
 * @author Kash
 * @date 06.10.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class AuthControllerActivation extends Controller {

    /**
     * Класс представления
     * @var AuthViewActivation
     */
    private $view;

    /**
     * Конструктор
     */
    public function __construct() {

        $this->view = new AuthViewActivation();
        $this->hash = new Hash();
        $this->auth = new Access();
    }

    /**
     * Метод, запускающий контроллер
     * @return mixed
     */
    public function execute() {

        //Получаем хэш и данные пользователя
        $code = Request::getStr('code');
        $userId = $this->hash->getIdByHash($code);
        $user = $this->auth->getUser($userId);

        //Если такой пользователь существует
        if ($user) {

            //Активируем его
            $this->auth->activateUser($userId);

            //Удаляем хэш
            $this->hash->delHash($code);

            //Показываем текст после удачного завершения активации
            return $this->view->display('success');
        }
        else {

            //Показываем ошибку
            return $this->view->display();
        }
    }
}