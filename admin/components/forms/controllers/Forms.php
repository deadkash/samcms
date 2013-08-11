<?php
/**
 * Контроллер списка форм
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 02.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FormsControllerForms extends Controller {

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
        $this->setModel('Form');

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
     * Сохраняет форму
     * @return void
     */
    private function save() {

        //Принимаем данные
        $form = new stdClass();
        $fields = FormsConsts::getFormFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $form->$fieldName = Request::getStr($fieldName);
            $field->value = $form->$fieldName;
        }

        //Если данные валидны
        $valid = Fields::validate($fields);
        if ($valid) {

            $this->model->addForm($form);

            //Добавляем сообщение
            Messages::addMessage('form_add', 'alert-success', Language::translate('forms_msg_form_add'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'forms',
                'View' => 'list'
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
        $form = new stdClass();
        $form->id = Request::getInt('form_id');
        $fields = FormsConsts::getFormFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $form->$fieldName = Request::getStr($fieldName);
            $field->value = $form->$fieldName;
        }

        //Если данные валидны
        $valid = Fields::validate($fields);
        if ($valid) {

            $this->model->updForm($form);

            //Добавляем сообщение
            Messages::addMessage('form_upd', 'alert-success', Language::translate('forms_msg_form_upd'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'forms',
                'View' => 'list'
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
     * Удаляет формы
     * @return void
     */
    private function delete() {

        $result = false;

        //Получаем данные
        $items = Request::getPostStr('item');

        //Удаляем элементы
        if (!empty($items)) {
            $result = $this->model->deleteForms($items);
        }

        //Добавляем сообщение
        if ($result) {
            Messages::addMessage(
                'forms_delete_success', 'alert-success',
                Language::translate('forms_msg_forms_delete_success'));
        }
        else Messages::addMessage(
            'forms_delete_fail', 'alert-danger', Language::translate('forms_msg_forms_delete_fail'));
    }
}