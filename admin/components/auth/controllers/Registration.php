<?php

/**
 * Контроллер регистрации
 *
 * @project SamCMS
 * @package Auth
 * @author kash
 * @date 23.09.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class AuthControllerRegistration extends Controller {

    /**
     * Класс представления
     * @var AuthViewRegistration
     */
    private $view;

    /**
     * Массив ошибок
     * @var array
     */
    private $errors;

    /**
     * Конструктор
     */
    public function __construct() {

        $this->view = new AuthViewRegistration();
        $this->errors = array();
        $this->auth = new Access();
        $this->hash = new Hash();
        $this->router = Router::create();
        $this->activSection = Parameters::getParameter('activation_section');
    }

    /**
     * Метод, запускающий контроллер
     * @return mixed
     */
    public function execute() {

        $action = Request::getStr('action');
        $user = array();

        if ($action == 'registration') {

            //Получаем данные с формы
            $user = $this->getRequestData();

            //Проверяем введенные пароли
            $comparePass = $this->auth->checkPasswords($user->password, $user->password2);
            if (!$comparePass) $this->errors[] = 'dont_match';

            //Проверка существования логина
            $loginExists = $this->auth->loginExists($user->login);
            if ($loginExists) $this->errors[] = 'login_exists';

            //Проверяем ввод логина
            if (empty($user->login)) $this->errors[] = 'login_empty';

            //Проверка длины пароля
            $correctPassLength = $this->auth->checkPassMinLength($user->password);
            if (!$correctPassLength) $this->errors[] = 'short_pass';

            //Проверка почтового адреса
            $checkEmail = ValidationHelper::checkEmail($user->email);
            if (!$checkEmail) $this->errors[] = 'invalid_email';

            //Проверка существования e-mail
            if ($this->auth->existEmail($user->email)) {
                $this->errors[] = 'mail_exists';
            }

            //Если данные пользователя валидны
            if (empty($this->errors)) {

                $user->id = $this->createUser($user);
                $this->sendMail($user);
                return $this->view->display('success');
            }
        }

        return $this->view->display('registration', $user, $this->errors);
    }

    /**
     * Получает данные пользователя, введенные в форму
     * @return stdClass
     */
    private function getRequestData() {

        $login = Request::getStr('login');
        $password = Request::getStr('password');
        $password2 = Request::getStr('password2');
        $email = Request::getStr('email');

        $user = new stdClass();

        $user->login = $login;
        $user->password = $password;
        $user->password2 = $password2;
        $user->email = $email;

        return $user;
    }

    /**
     * Создаем пользователя
     *
     * @param $user
     * @return int
     */
    private function createUser($user) {

        unset($user->password2);
        return $this->auth->createUser(clone $user);
    }

    /**
     * Отправка письма пользователю
     * @param $user
     */
    private function sendMail($user) {

        //Регистрация ключа активации
        $code = $this->hash->createKey($user->id, 3);
        $data['url'] = 'http://'.$_SERVER['HTTP_HOST'].$this->router->rewriteUrl('/index.php?id='.$this->activSection.'&code='.$code);
        $data['user'] = $user;

        $body = Templater::render('modules', 'auth/views/registration/templates/letter.twig', $data);

        $subject = 'Регистрация на '.$_SERVER['HTTP_HOST'];
        $mailFrom = 'noreply@'.$_SERVER['HTTP_HOST'];

        Mailer::sendMail($user->email, $mailFrom, $subject, $body);
    }
}