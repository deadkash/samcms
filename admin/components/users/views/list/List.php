<?php

/**
 * Список пользователей
 *
 * @project SamCMS
 * @package Users
 * @author Kash
 * @date 30.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class UsersViewList extends View {

    /**
     * Конструктор
     */
    public function __construct($viewName) {
        parent::__construct($viewName);
    }

    /**
     * Отрисовка
     * @return string
     */
    public function display() {

        $controller = Request::getStr('controller');
        switch ($controller) {

            case 'users':
                return $this->showUsersList();
                break;

            case 'groups':
                return $this->showGroupsList();
                break;

            default:
                return $this->showUsersList();
                break;
        }
    }

    /**
     * Возвращает список пользователей
     * @return string
     */
    private function showUsersList() {

        //Загружаем модель
        $this->setModel('User');

        //Список пользователей
        $users = $this->model->getUsers();
        foreach ($users as &$user) {

            $user->edit = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'users',
                'view' => 'edit',
                'user_id' => $user->id
            ));
            $user->date = DatetimeHelper::prepareDate($user->date);
        }
        if (!empty($users)) $this->setValue('users', $users);

        //Адрес отправки формы
        $postUrl = $this->router->getUrl(array('id' => $this->itemId,'controller' => 'users','view' => 'list'));
        $this->setValue('url', $postUrl);

        //Ссылка на группы пользователей
        $groupLink = $this->router->getUrl(array('id' => $this->itemId,'controller' => 'groups','view' => 'list'));
        $this->setValue('groups', $groupLink);

        //Ссылка на добавление
        $addLink = $this->router->getUrl(array('id' => $this->itemId,'controller' => 'users','view' => 'add'));
        $this->setValue('add', $addLink);

        //Установка шаблона
        $this->setTemplate('users_list.twig');

        return $this->render();
    }

    /**
     * Возвращает список групп
     * @return string
     */
    private function showGroupsList() {

        //Загружаем модель
        $this->setModel('Group');

        //Список групп
        $groups = $this->model->getGroups();
        foreach ($groups as &$group) {
            $group->edit = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'groups',
                'view' => 'edit',
                'group_id' => $group->id
            ));
            $group->policy = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'groups',
                'view' => 'policy',
                'group_id' => $group->id
            ));
        }
        if (!empty($groups)) $this->setValue('groups', $groups);

        //Адрес отправки формы
        $postUrl = $this->router->getUrl(array('id' => $this->itemId,'controller' => 'groups','view' => 'list'));
        $this->setValue('url', $postUrl);

        //Ссылка на список пользователей
        $usersLink = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'users','view'=>'list'));
        $this->setValue('users', $usersLink);

        //Ссылка на форму добавления
        $addLink = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'groups','view'=>'add'));
        $this->setValue('add', $addLink);

        //Установка шаблона
        $this->setTemplate('groups_list.twig');

        return $this->render();
    }
}