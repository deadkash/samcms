<?php
/**
 * Редактирование
 *
 * @project SamCMS
 * @package Users
 * @author Kash
 * @date 01.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class UsersViewEdit extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Отрисовка html кода
     * @return mixed
     */
    public function display() {

        $controller = Request::getStr('controller');
        switch ($controller) {

            case 'users':
                return $this->showEditUsers();
                break;

            case 'groups':
                return $this->showEditGroups();
                break;

            default:
                return $this->showEditUsers();
                break;
        }
    }

    /**
     * Редактирование группы
     * @return string
     */
    private function showEditGroups(){

        //Устанавливаем модель
        $this->setModel('Group');

        //Загружаем группу
        $groupId = Request::getInt('group_id');
        if (!$groupId) $this->router->redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));
        $group = $this->model->getGroupById($groupId);
        if (!$group) $this->router->redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));
        $this->setValue('group', $group);

        //Адрес отправки формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'groups','view'=>'edit','group_id'=>$groupId));
        $this->setValue('url', $postUrl);

        //Ошибки
        $this->setValue('errors', Messages::getMessages());

        //Устанавливаем шаблон
        $this->setTemplate('edit_group.twig');

        return $this->render();
    }

    /**
     * Редактирование пользователя
     * @return string
     */
    private function showEditUsers(){

        //Устанавливаем модель
        $this->setModel('User');

        //Загружаем пользователя
        $userId = Request::getInt('user_id');
        if (!$userId) $this->router->redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));
        $user = $this->model->getUserById($userId);
        if (!$user) $this->router->redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));
        $this->setValue('user', $user);

        //Группы
        $groups = $this->getModel('group')->getGroups();
        if (!empty($groups)) $this->setValue('groups', $groups);

        //Ошибки
        $this->setValue('errors', Messages::getMessages());

        //Адрес отправки формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'users','view'=>'edit','user_id'=>$userId
        ));
        $this->setValue('url', $postUrl);

        //Устанавливаем шаблон
        $this->setTemplate('edit_user.twig');

        return $this->render();
    }
}