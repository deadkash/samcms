<?php

/**
 * Контроллер категорий материалов
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 23.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsControllerCategories extends Controller {

    /**
     * Представление по умолчанию
     * @var string
     */
    private $defaultView = 'Categorylist';

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
        $this->setModel('Category');

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
     * Сохраняет категорию
     * @return void
     */
    private function save() {

        //Принимаем данные
        $category = new stdClass();
        $fields = MaterialsConsts::getCategoryFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $category->$fieldName = Request::getStr($fieldName);
            $field->value = $category->$fieldName;
        }

        //Валидация
        $valid = Fields::validate($fields);
        if ($valid) {

            $this->model->addCategory($category);

            //Добавляем сообщение
            Messages::addMessage('category_add', 'alert-success', Language::translate('materials_msg_category_add'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'categories',
                'view' => 'categorylist'
            ));
            $this->router->redirect($redirectUrl);
        }
        else {

            //Добавляем сообщение
            Fields::setMessages($fields, $this->component);
            Fields::setErrors($fields);
        }
    }

    /**
     * Обновляет категорию
     * @return void
     */
    private function update() {

        //Принимаем данные
        $category = new stdClass();
        $category->id = Request::getInt('category_id');
        $fields = MaterialsConsts::getCategoryFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $category->$fieldName = Request::getStr($fieldName);
            $field->value = $category->$fieldName;
        }

        //Валидация
        if (Fields::validate($fields)) {

            $this->model->updCategory($category);

            //Добавляем сообщение
            Messages::addMessage('category_upd', 'alert-success', Language::translate('materials_msg_category_upd'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'categories',
                'view' => 'categorylist'
            ));
            $this->router->redirect($redirectUrl);
        }
        else {

            //Добавляем сообщение
            Fields::setMessages($fields, $this->component);
        }
    }

    /**
     * Удаляет категории
     * @return void
     */
    private function delete() {

        $result = false;

        //Получаем данные
        $items = Request::getPostStr('item');

        //Удаляем элементы
        if (!empty($items)) {
            $result = $this->model->deleteCategories($items);
        }

        //Добавляем сообщение
        if ($result) {
            Messages::addMessage(
                'categories_delete_success', 'alert-success',
                Language::translate('materials_msg_categories_delete_success'));
        }
        else Messages::addMessage(
            'categories_delete_fail', 'alert-danger', Language::translate('materials_msg_categories_delete_fail'));
    }
}