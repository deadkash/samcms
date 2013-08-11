<?php
/**
 * Представление добавления
 *
 * @project SamCMS
 * @package 
 * @author Kash
 * @date 01.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class UsersViewAdd extends View {

    /**
     * Конструктор
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Отрисовка html
     * @return string
     */
    public function display() {

        $controller = Request::getStr('controller');
        switch ($controller) {

            case 'users':
                return $this->showAddUser();
                break;

            case 'groups':
                return $this->showAddGroup();
                break;

            default:
                return $this->showAddUser();
                break;
        }
    }

    /**
     * Показывает форму добавления новой группы пользователей
     * @return string
     */
    private function showAddGroup() {

        $this->setModel('Group');
        $this->setTemplate('add_group.twig');

        //Адрес отправки формы
        $postUrl = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'groups','view'=>'add'));
        $this->setValue('url', $postUrl);

        //Ошибки
        $this->setValue('messages', Messages::getMessages());

        return $this->render();
    }

    /**
     * Показывает форму добавления нового пользователя
     * @return string
     */
    private function showAddUser() {

        $this->setModel('User');
        $this->setTemplate('add_user.twig');

        //Адрес отправки формы
        $postUrl = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'users','view'=>'add'));
        $this->setValue('url', $postUrl);

        //Группы
        $groups = $this->getModel('group')->getGroups();
        if (!empty($groups)) $this->setValue('groups', $groups);

        //Загружаем данные предыдущего заполнения
        $user = new stdClass();
        $user->login = Request::getStr('login');
        $user->email = Request::getStr('email');
        $user->policy_id = Request::getInt('policy_id');
        $user->active = Request::getInt('active', 0);
        $this->setValue('user', $user);

        //Ошибки
        $this->setValue('errors', Messages::getMessages());

        return $this->render();
    }
}