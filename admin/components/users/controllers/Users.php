<?php

/**
 * Контроллер списка пользователей
 *
 * @project SamCMS
 * @package Users
 * @author Kash
 * @date 30.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class UsersControllerUsers extends Controller {

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
        $this->setModel('User');

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
        }

        //Загружаем представление
        $viewName = Request::getStr('view', $this->defaultView);
        $view = $this->getView($viewName);
        if (!$view) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));

        return $view->display();
    }

    /**
     * Новый пользователь
     * @return void
     */
    private function save(){

        //Загружаем данные
        $user = new stdClass();
        $user->login = Request::getStr('login');
        $user->email = Request::getStr('email');
        $user->password = Request::getStr('password');
        $user->password_confirmed = Request::getStr('password_confirmed');
        $user->policy_id = Request::getInt('policy_id');
        $user->active = Request::getInt('active', 0);

        //Валидация данных
        $validateUser = $this->model->validateUser($user);
        if ($validateUser) {

            $result = $this->model->addUser($user);

            if ($result) {

                //Показываем сообщение
                Messages::addMessage(
                    'user_add_success', 'alert-success', Language::translate('users_msg_user_add_success'));

                //Редиректим на список
                $redirectUrl = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'users','view'=>'list'));
                $this->router->redirect($redirectUrl);
            }
            else {
                Messages::addMessage('user_add_fail', 'alert-fail', Language::translate('users_msg_user_add_fail'));
            }
        }
    }

    /**
     * Обновляет пользователя
     * @return void
     */
    private function update(){

        //Загружаем данные
        $user = new stdClass();
        $user->id = Request::getInt('user_id');
        $user->email = Request::getStr('email');
        $user->password = Request::getStr('password');
        $user->password_confirmed = Request::getStr('password_confirmed');
        $user->policy_id = Request::getInt('policy_id');
        $user->active = Request::getInt('active', 0);

        //Не проверять пароль, если его не задавали
        $checkPass = (!empty($user->password) && !empty($user->password_confirmed));

        //Валидация данных
        $validateUser = $this->model->validateUser($user, $checkPass);
        if ($validateUser) {

            $result = $this->model->updUser($user, $checkPass);

            if ($result) {

                //Показываем сообщение
                Messages::addMessage(
                    'user_upd_success', 'alert-success', Language::translate('users_msg_user_upd_success'));

                //Редиректим на список
                $redirectUrl = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'users','view'=>'list'));
                $this->router->redirect($redirectUrl);
            }
            else {
                Messages::addMessage('user_add_fail', 'alert-fail', Language::translate('users_msg_user_upd_fail'));
            }
        }
    }

    /**
     * Удаляет пользователей
     * @return void
     */
    private function delete() {

        $result = false;

        //Получаем данные
        $items = Request::getPostStr('item');

        //Удаляем элементы
        if (!empty($items)) {
            $result = $this->model->deleteUsers($items);
        }

        //Добавляем сообщение
        if ($result) {
            Messages::addMessage(
                'users_delete_success', 'alert-success', Language::translate('users_msg_users_delete_success'));
        }
        else Messages::addMessage('users_delete_fail', 'alert-danger', Language::translate('users_msg_users_delete_fail'));
    }
}