<?php

/**
 * Редактирование категории
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 25.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsViewEdit extends View {

    /**
     * Конструктор
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Отрисовка
     * @return string
     */
    public function display() {

        $controller = Request::getStr('controller');
        switch ($controller) {

            case 'categories':

                //Устанавливаем шаблон
                $this->setTemplate('edit_category.twig');

                //Загружаем модель
                $this->setModel('Category');

                //Категория
                $categoryId = Request::getInt('category_id');
                $category = $this->model->getCategoryById($categoryId);
                $this->setValue('category', $category);

                //Поля категории
                $fields = MaterialsConsts::getCategoryFields();
                foreach ($fields as &$field) {
                    /** @var Field $field */
                    $fieldName = $field->name;
                    $field->default = $category->$fieldName;
                    $field->setHtml();
                }
                $this->setValue('fields', $fields);

                //Адрес отправки формы
                $postUrl = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'categories','view'=>'Edit'));
                $this->setValue('url', $postUrl);

                return $this->render();
                break;

            case 'materials':

                //Загружаем модель
                $this->setModel('Material');

                //Загружаем материал
                $materialId = Request::getInt('material_id');
                $material = $this->model->getMaterialById($materialId);
                $this->setValue('material_id', $materialId);

                //Переворачиваем дату
                $material->date = date('d.m.Y H:i:s', strtotime($material->date));

                //Загружаем редакторы
                $fields = MaterialsConsts::getMaterialFields();
                foreach ($fields as &$field) {
                    /** @var Field $field */
                    $fieldName = $field->name;
                    $field->default = $material->$fieldName;
                    $field->setHtml();
                }
                $this->setValue('fields', $fields);

                //Адрес отправки формы
                $postUrl = $this->router->getUrl(array(
                    'id'=>$this->itemId,'controller'=>'Materials','view'=>'Edit','material_id'=>$materialId));
                $this->setValue('url', $postUrl);

                //Устанавливаем шаблон
                $this->setTemplate('edit_material.twig');

                return $this->render();
                break;
        }

        return false;
    }
}