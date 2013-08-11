<?php

/**
 * Представление восстановления пароля
 *
 * @project SamCMS
 * @package Auth
 * @author Kash
 * @date 06.10.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class AuthViewRecover extends View {

    /**
     * Путь к шаблону
     * @var string
     */
    private $tpl;

    /**
     * Данные для шаблонизатора
     * @var array
     */
    private $data;

    /**
     * Конструктор
     */
    public function __construct() {

        $this->tpl = 'auth/views/recover/templates/step1.twig';
        $this->data = array();
        $this->router = Router::create();
        $this->authSection = Parameters::getParameter('auth_section');
        $this->regSection = Parameters::getParameter('reg_section');
    }

    /**
     * Вывод html кода
     *
     * @param $step string
     * @param array $data
     * @return string
     */
    public function display($step, $data = array()) {

        switch ($step) {

            case 'step1':

                $this->tpl = 'auth/views/recover/templates/step1.twig';
                $this->data['auth'] = $this->router->rewriteUrl('/index.php?id='.$this->authSection);
                $this->data['reg'] = $this->router->rewriteUrl('/index.php?id='.$this->regSection);
                $this->data['errors'] = $data;
                break;

            case 'step2':

                $this->tpl = 'auth/views/recover/templates/step2.twig';
                break;

            case 'step3':

                $this->tpl = 'auth/views/recover/templates/step3.twig';
                $this->data = $data;
                break;

            case 'step4':

                $this->tpl = 'auth/views/recover/templates/step4.twig';
                $this->data['auth'] = $this->router->rewriteUrl('/index.php?id='.$this->authSection);
                break;

            case 'error':

                $this->tpl = 'auth/views/recover/templates/error.twig';
                $this->data = $data;
                break;
        }

        return parent::render($this->tpl, $this->data);
    }
}