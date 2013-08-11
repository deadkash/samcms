<?php

/**
 * Представление активации аккаунта
 *
 * @project SamCMS
 * @package Auth
 * @author Kash
 * @date 06.10.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class AuthViewActivation extends View {

    /**
     * Путь к шаблону
     * @var string
     */
    private $tpl;

    /**
     * Массив данных для шаблонизатора
     * @var array
     */
    private $data;

    /**
     * Конструктор
     */
    public function __construct() {

        $this->router = Router::create();
        $this->authSection = Parameters::getParameter('auth_section');
        $this->tpl = 'auth/views/activation/templates/error.twig';
        $this->data = array();
    }

    /**
     * Вывод html кода
     *
     * @param string $type
     * @return string
     */
    public function display($type = 'error') {

        switch ($type) {

            case 'success':

                $this->tpl = 'auth/views/activation/templates/success.twig';
                $this->data['auth'] = $this->router->rewriteUrl('/index.php?id='.$this->authSection);
                break;
        }

        return parent::render($this->tpl, $this->data);
    }
}
