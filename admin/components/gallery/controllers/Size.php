<?php
/**
 * Контроллер размеров фотогалереи
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 15.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryControllerSize extends Controller {

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
        $this->setModel('Size');

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
     * Сохранение размера
     * @return void
     */
    private function save() {

        //Принимаем данные
        $size = new stdClass();
        $size->session_id = Request::getInt('session_id');
        $fields = GalleryConsts::getSizeFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $size->$fieldName = Request::getStr($fieldName);
            $field->value = $size->$fieldName;
        }

        //Если данные валидны
        $valid = Fields::validate($fields);
        if ($valid) {

            $this->model->addSize($size);

            //Добавляем сообщение
            Messages::addMessage('size_add', 'alert-success', Language::translate('gallery_msg_size_add'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'size',
                'view' => 'list',
                'session_id' => Request::getInt('session_id')
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
     * Изменение размера
     * @return void
     */
    private function update() {

        //Принимаем данные
        $size = new stdClass();
        $size->id = Request::getInt('size_id');
        $fields = GalleryConsts::getSizeFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $size->$fieldName = Request::getStr($fieldName);
            $field->value = $size->$fieldName;
        }

        //Если данные валидны
        $valid = Fields::validate($fields);
        if ($valid) {

            $this->model->updSize($size);

            //Добавляем сообщение
            Messages::addMessage('size_upd', 'alert-success', Language::translate('gallery_msg_size_upd'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'size',
                'view' => 'list',
                'session_id' => Request::getInt('session_id')
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
     * Удаление размеров
     * @return void
     */
    private function delete() {

        $result = false;

        //Получаем данные
        $items = Request::getPostStr('item');

        //Удаляем элементы
        if (!empty($items)) {
            $result = $this->model->delete($items);
        }

        //Добавляем сообщение
        if ($result) {
            Messages::addMessage(
                'sizes_delete_success', 'alert-success',
                Language::translate('gallery_msg_sizes_delete_success'));
        }
        else Messages::addMessage(
            'sizes_delete_fail', 'alert-danger', Language::translate('gallery_msg_sizes_delete_fail'));
    }
}