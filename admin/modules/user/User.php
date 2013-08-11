<?php

/**
 * Модуль вывода текущего пользователя и навигации
 *
 * @project SamCMS
 * @package module
 * @author kash
 * @date 23.09.12
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class User extends Module {

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data;

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath;

    /**
     * Конструктор
     */
    public function __construct() {

        $this->tplPath = 'user/template.twig';
        $this->data = array();
        $this->auth = new Access();
        $this->router = Router::create();
        $this->profileSection = 116;
    }

    /**
     * Отрисовка html Кода
     * @return string
     */
    public function render() {

        $user = $this->auth->getCurrentUser();
        $this->data['user'] = $user;
        $this->data['logout'] = $this->router->getUrl(array(
            'id' => Parameters::getParameter('auth_section'),
            'action' => 'logout'
        ));
        $this->data['profile'] = $this->router->rewriteUrl('/index.php?id='.$this->profileSection.'&view=main');

        return parent::render($this->tplPath, $this->data);
    }
}