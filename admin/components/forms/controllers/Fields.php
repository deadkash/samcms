<?php

/**
 * Контроллер полей формы
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 07.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class FormsControllerFields extends Controller {

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
        $this->setModel('Field');

        //Движение элементов
        $moveUp = Request::getInt('moveup');
        $moveDown = Request::getInt('movedown');

        if ($moveUp) $this->model->moveUp($moveUp);
        if ($moveDown) $this->model->moveDown($moveDown);

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
     * Сохраняет поле
     * @return void
     */
    private function save() {

        //Принимаем данные
        $formId = Request::getInt('form_id');
        $formField = new stdClass();
        $formField->form_id = $formId;
        $formField->ordering = $this->model->getLastPosition($formId) + 1;
        $fields = FormsConsts::getFieldFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $formField->$fieldName = Request::getStr($fieldName);
            $field->value = $formField->$fieldName;
        }

        //Если данные валидны
        $valid = Fields::validate($fields);
        if ($valid) {

            $this->model->addField($formField);

            //Добавляем сообщение
            Messages::addMessage('field_add', 'alert-success', Language::translate('forms_msg_field_add'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'fields',
                'view' => 'list',
                'form_id' => $formId
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
     * Обновление формы
     * @return void
     */
    public function update() {

        //Принимаем данные
        $formField = new stdClass();
        $formField->id = Request::getInt('field_id');
        $formField->form_id = Request::getInt('form_id');
        $fields = FormsConsts::getFieldFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $formField->$fieldName = Request::getStr($fieldName);
            $field->value = $formField->$fieldName;
        }

        //Если данные валидны
        $valid = Fields::validate($fields);
        if ($valid) {

            $this->model->updField($formField);

            //Добавляем сообщение
            Messages::addMessage('form_upd', 'alert-success', Language::translate('forms_msg_field_upd'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'fields',
                'view' => 'list',
                'form_id' => Request::getInt('form_id')
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
     * Удаляет поля
     * @return void
     */
    private function delete() {

        $result = false;

        //Получаем данные
        $items = Request::getPostStr('item');

        //Удаляем элементы
        if (!empty($items)) {
            $result = $this->model->deleteFields($items);
        }

        //Добавляем сообщение
        if ($result) {
            Messages::addMessage(
                'forms_delete_success', 'alert-success',
                Language::translate('forms_msg_fields_delete_success'));
        }
        else Messages::addMessage(
            'forms_delete_fail', 'alert-danger', Language::translate('forms_msg_fields_delete_fail'));
    }
}