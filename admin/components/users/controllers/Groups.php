<?php
/**
 * Контроллер группы пользователей
 *
 * @project SamCMS
 * @package Users
 * @author Kash
 * @date 30.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class UsersControllerGroups extends Controller {

    /**
     * Представление по умолчанию
     * @var string
     */
    private $defaultView = 'List';

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Запуск контроллера
     * @return mixed|void
     */
    public function execute() {

        //Загружаем модель
        $this->setModel('Group');

        //Обработка данных
        $task = Request::getStr('task');
        switch ($task) {

            case 'save':
                $this->save();
                break;

            case 'update':
                $this->update();
                break;

            case 'delete':
                $this->delete();
                break;

            case 'policy':
                $this->policy();
                break;
        }

        //Загружаем представление
        $viewName = Request::getStr('view', $this->defaultView);
        $view = $this->getView($viewName);
        if (!$view) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));

        return $view->display();
    }

    /**
     * Сохраняет группу
     * @return void
     */
    private function save() {

        //Принимаем данные
        $group = new stdClass();
        $group->name = Request::getStr('name');

        //Если название не пустое
        if (!empty($group->name)) {

            $this->model->addGroup($group);

            //Добавляем сообщение
            Messages::addMessage('group_add', 'alert-success', Language::translate('users_msg_group_add'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'groups',
                'view' => 'list'
            ));
            $this->router->redirect($redirectUrl);
        }
        else {

            //Добавляем сообщение
            Messages::addMessage('group_add', 'alert-danger', Language::translate('users_msg_empty_title'));
        }
    }

    /**
     * Обновляет группу
     * @return void
     */
    private function update(){

        //Принимаем данные
        $group = new stdClass();
        $group->id = Request::getInt('group_id');
        $group->name = Request::getStr('name');

        //Если название не пустое
        if (!empty($group->name)) {

            $this->model->updGroup($group);

            //Добавляем сообщение
            Messages::addMessage('group_upd', 'alert-success', Language::translate('users_msg_group_upd'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'groups',
                'view' => 'list'
            ));
            $this->router->redirect($redirectUrl);
        }
        else {

            //Добавляем сообщение
            Messages::addMessage('group_upd', 'alert-danger', Language::translate('users_msg_empty_title'));
        }
    }

    /**
     * Удаляет группы
     * @return void
     */
    private function delete() {

        $result = false;

        //Получаем данные
        $items = Request::getPostStr('item');

        //Удаляем элементы
        if (!empty($items)) {
            $result = $this->model->deleteGroups($items);
        }

        //Добавляем сообщение
        if ($result) {
            Messages::addMessage(
                'groups_delete_success', 'alert-success', Language::translate('users_msg_groups_delete_success'));
        }
        else Messages::addMessage(
            'groups_delete_fail', 'alert-danger', Language::translate('users_msg_groups_delete_fail'));
    }

    /**
     * Обновление политик доступа
     * @return void
     */
    private function policy(){

        $policyId = Request::getInt('policy_id');
        $allows = Request::getPostStr('allow');
        $denies = Request::getPostStr('deny');

        $result = $this->model->updPolicies($policyId, $allows, $denies);

        if ($result) {

            //Добавляем сообщение
            Messages::addMessage('policy_upd', 'alert-success', Language::translate('users_msg_policy_upd'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'groups',
                'view' => 'list'
            ));
            $this->router->redirect($redirectUrl);
        }
        else {
            Messages::addMessage('policy_upd', 'alert-danger', Language::translate('users_msg_policy_upd_fail'));
        }
    }
}