<?php

/**
 * Контроллер восстановления пароля
 *
 * @project SamCMS
 * @package Auth
 * @author Kash
 * @date 06.10.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class AuthControllerRecover extends Controller {

    /**
     * Класс представления
     * @var AuthViewRecover
     */
    private $view;

    /**
     * Конструктор
     */
    public function __construct() {

        $this->view = new AuthViewRecover();
        $this->auth = new Access();
        $this->hash = new Hash();
        $this->router = Router::create();
        $this->recoverSection = Parameters::getParameter('recover_section');
    }

    /**
     * Метод, запускающий контроллер
     * @return mixed
     */
    public function execute() {

        //Получаем шаг из запроса
        $step = Request::getInt('step', 1);

        //Если пришел код, то переходим к третьему этапу
        $code = Request::getstr('code', false);
        if ($code && $step == 1) $step = 3;

        switch ($step) {

            case 1:
                return $this->view->display('step1');
                break;

            case 2:
                return $this->step2();
                break;

            case 3:
                return $this->step3($code);
                break;

            case 4:
                return $this->step4($code);
                break;

            default:
                return $this->view->display('step1');
        }
    }

    /**
     * Второй шаг восстановления пароля
     * @return string
     */
    private function step2() {

        $email = Request::getStr('email');

        $errors = array();
        if (!ValidationHelper::checkEmail($email)) {
            $errors[] = 'invalid_email';
            return $this->view->display('step1', $errors);
        }

        $userId = $this->auth->existEmail($email);
        if (!$userId) {
            $errors[] = 'mail_not_exists';
            return $this->view->display('step1', $errors);
        }

        if (!$this->sendMail($email, $userId)) {
            $errors[] = 'mail_not_send';
        }

        if (empty($errors)) {
            return $this->view->display('step2');
        }
        else return $this->view->display('step1', $errors);
    }

    /**
     * Третий шаг восстановления пароля
     *
     * @param $code
     * @return string
     */
    private function step3($code) {

        $userId = $this->hash->getIdByHash($code);
        $user = $this->auth->getUser($userId);

        //Если такой пользователь существует
        if ($user) {

            $data['code'] = $code;
            return $this->view->display('step3', $data);
        }
        else {
            return $this->view->display('error', array('login_not_exists' => true));
        }
    }

    /**
     * Последний шаг восстановления пароля
     *
     * @param $code
     * @return string
     */
    private function step4($code) {

        $userId = $this->hash->getIdByHash($code);
        $user = $this->auth->getUser($userId);

        if ($user) {

            $pass = Request::getStr('pass');
            $pass2 = Request::getStr('pass2');

            $errors = array();

            //Проверяем введенные пароли
            if (!$this->auth->checkPasswords($pass, $pass2)) {
                $errors[] = 'dont_match';
            }

            //Проверяем длину пароля
            if (!$this->auth->checkPassMinLength($pass)) {
                $errors[] = 'short_pass';
            }

            //Если не набрали ошибок, то меняем пароль и удаляем хэш
            if (empty($errors)) {

                $this->auth->changePassword($user->id, $pass);
                $this->hash->delHash($code);

                return $this->view->display('step4');
            }
            else {
                return $this->view->display('step3', array('errors' => $errors));
            }
        }
        else {
            return $this->view->display('error', array('login_not_exists' => true));
        }
    }

    /**
     * Отсылает письмо с ссылкой
     *
     * @param $email
     * @param $userId
     * @return bool
     */
    private function sendMail($email, $userId) {

        $hash = $this->hash->createKey($userId, 1);
        $data['url'] = $this->router->getUrl(array('id'=>$this->recoverSection,'code'=>$hash));
        $data['host'] = $_SERVER['HTTP_HOST'];

        $body = Templater::render('components', 'auth/views/recover/templates/letter.twig', $data);

        $subject = 'Восстановление пароля на '.$_SERVER['HTTP_HOST'];
        $mailFrom = 'noreply@'.$_SERVER['HTTP_HOST'];

        return Mailer::sendMail($email, $mailFrom, $subject, $body);
    }
}