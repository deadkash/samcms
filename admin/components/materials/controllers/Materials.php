<?php

/**
 * Контроллер материалов
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 25.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsControllerMaterials extends Controller {

    /**
     * Представление по умолчанию
     * @var string
     */
    private $defaultView = 'Materialslist';

    /**
     * Констурктор
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
        $this->setModel('Material');

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
     * Сохраняет материал
     * @return void
     */
    private function save() {

        //Принимаем данные
        $material = new stdClass();
        $fields = MaterialsConsts::getMaterialFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $material->$fieldName = Request::getStr($fieldName);
            $field->value = $material->$fieldName;
        }

        //Переводим дату
        $material->date = date('Y-m-d H:i:s', strtotime($material->date));

        //Валидация
        $valid = Fields::validate($fields);
        if ($valid) {

            //Подготавливаем сео-поля
            $material = $this->model->prepareSEO($material);

            $this->model->addMaterial($material);

            //Добавляем сообщение
            Messages::addMessage('material_add', 'alert-success', Language::translate('materials_msg_material_add'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'Materials',
                'view' => 'Materialslist'
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
     * Обновляет материал
     * @return void
     */
    public function update() {

        //Принимаем данные
        $material = new stdClass();
        $material->id = Request::getInt('material_id');
        $fields = MaterialsConsts::getMaterialFields();
        foreach ($fields as &$field) {

            $fieldName = $field->name;
            $material->$fieldName = Request::getStr($fieldName);
            $field->value = $material->$fieldName;
        }

        //Переводим дату
        $material->date = date('Y-m-d H:i:s', strtotime($material->date));

        //Если название не пустое
        $valid = Fields::validate($fields);
        if ($valid) {

            //Подготавливаем сео-поля
            $material = $this->model->prepareSEO($material);

            $this->model->updMaterial($material);

            //Добавляем сообщение
            Messages::addMessage('material_upd', 'alert-success', Language::translate('materials_msg_material_upd'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'Materials',
                'view' => 'Materialslist'
            ));
            $this->router->redirect($redirectUrl);
        }
        else {

            //Добавляем сообщение
            Fields::setMessages($fields, $this->component);
        }
    }

    /**
     * Удаляет материалы
     * @return void
     */
    private function delete() {

        $result = false;

        //Получаем данные
        $items = Request::getGetStr('item');

        //Удаляем элементы
        if (!empty($items)) {
            $result = $this->model->deleteMaterials($items);
        }

        //Добавляем сообщение
        if ($result) {
            Messages::addMessage(
                'materials_delete_success', 'alert-success',
                Language::translate('materials_msg_materials_delete_success'));
        }
        else Messages::addMessage(
            'materials_delete_fail', 'alert-danger', Language::translate('materials_msg_materials_delete_fail'));
    }
}