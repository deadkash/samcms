<?php
/**
 * Контроллер фотосессий
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 09.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryControllerSession extends Controller {

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
        $this->setModel('Session');

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
     * Сохранение фотосессии
     * @return void
     */
    private function save() {

        //Принимаем данные
        $session = new stdClass();
        $fields = GalleryConsts::getSessionFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $session->$fieldName = Request::getStr($fieldName);
            $field->value = $session->$fieldName;
        }

        //Если данные валидны
        $valid = Fields::validate($fields);
        if ($valid) {

            $this->model->addSession($session);

            //Добавляем сообщение
            Messages::addMessage('session_add', 'alert-success', Language::translate('gallery_msg_session_add'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'session',
                'view' => 'list'
            ));
            $this->router->redirect($redirectUrl);
        }
        else {

            //Добавляет сообщения
            Fields::setMessages($fields, $this->component);
            Fields::setErrors($fields);
        }
    }

    /**
     * Обновление фотосессии
     * @return void
     */
    private function update() {

        //Принимаем данные
        $session = new stdClass();
        $session->id = Request::getInt('session_id');
        $fields = GalleryConsts::getSessionFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $session->$fieldName = Request::getStr($fieldName);
            $field->value = $session->$fieldName;
        }

        //Если данные валидны
        $valid = Fields::validate($fields);
        if ($valid) {

            $this->model->updSession($session);

            //Добавляем сообщение
            Messages::addMessage('session_upd', 'alert-success', Language::translate('gallery_msg_session_upd'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'session',
                'view' => 'list'
            ));
            $this->router->redirect($redirectUrl);
        }
        else {

            //Добавляет сообщения
            Fields::setMessages($fields, $this->component);
            Fields::setErrors($fields);
        }
    }

    /**
     * Удаление фотосессий
     * @return void
     */
    private function delete() {

        $result = false;

        //Получаем данные
        $items = Request::getPostStr('item');

        //Удаляем элементы
        if (!empty($items)) {
            $result = $this->model->deleteSessions($items);
        }

        //Добавляем сообщение
        if ($result) {
            Messages::addMessage(
                'sessions_delete_success', 'alert-success',
                Language::translate('gallery_msg_sessions_delete_success'));
        }
        else Messages::addMessage(
            'sessions_delete_fail', 'alert-danger', Language::translate('gallery_msg_sessions_delete_fail'));
    }
}