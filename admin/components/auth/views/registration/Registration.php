<?php

/**
 * Представление регистрации
 *
 * @project SamCMS
 * @package Auth
 * @author kash
 * @date 23.09.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class AuthViewRegistration extends View {

    /**
     * Путь к шаблону
     * @var string
     */
    private $tplPath;

    /**
     * Данные для шаблонизатора
     * @var array
     */
    private $data;

    /**
     * Конструктор
     */
    public function __construct() {

        $this->tplPath = 'auth/views/registration/templates/form.twig';
        $this->data = array();
        $this->router = Router::create();
        $this->authSection = Parameters::getParameter('auth_section');
    }

    /**
     * Показывает форму регистрации
     *
     * @param array $errors массив ошибок предыдущей регистрации
     * @param $user
     * @param $type string
     * @return string
     */
    public function display($type, $user = false, $errors = array()) {

        switch ($type) {

            case 'registration':

                $this->tplPath = 'auth/views/registration/templates/form.twig';
                $this->data['errors'] = $errors;
                $this->data['user'] = $user;
                $this->data['auth'] = $this->router->rewriteUrl('/index.php?id='.$this->authSection);
                break;

            case 'success':

                $this->data['auth'] = $this->router->rewriteUrl('/index.php?id='.$this->authSection);
                $this->tplPath = 'auth/views/registration/templates/success.twig';
                break;
        }

        return parent::render($this->tplPath, $this->data);
    }
}