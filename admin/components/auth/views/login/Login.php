<?php

/**
 * Представление авторизации
 *
 * @project SamCMS
 * @package Auth
 * @author kash
 * @date 23.09.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class AuthViewLogin extends View {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath;

    /**
     * Данные для шаблонизатора
     * @var array
     */
    protected $data;

    /**
     * Конструктор
     */
    public function __construct() {

        $this->tplPath = 'auth/views/login/templates/login.twig';
        $this->data = array();
        $this->router = Router::create();
        $this->regSection = Parameters::getParameter('reg_section');
        $this->recSection = Parameters::getParameter('recover_section');
    }

    /**
     * Выводит html код
     *
     * @param string $result
     * @return string
     */
    public function display($result = 'success') {

        $this->data['result'] = $result;
        $this->data['reg'] = $this->router->rewriteUrl('/index.php?id='.$this->regSection);
        $this->data['recover'] = $this->router->rewriteUrl('/index.php?id='.$this->recSection);

        return parent::render($this->tplPath, $this->data);
    }
}