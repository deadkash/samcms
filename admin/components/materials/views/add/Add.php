<?php

/**
 * Представление добавление
 *
 * @package Materials
 * @project SamCMS
 * @author Kash
 * @date 25.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsViewAdd extends View {

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
                $this->setTemplate('add_category.twig');

                //Поля категории
                $fields = MaterialsConsts::getCategoryFields();
                /** @var $field Field */
                foreach ($fields as &$field) { $field->setHtml(); }
                $this->setValue('fields', $fields);

                //Адрес отправки формы
                $postUrl = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'Categories','view'=>'Add'));
                $this->setValue('url', $postUrl);

                return $this->render();
                break;

            case 'materials':

                //Устанавливаем шаблон
                $this->setTemplate('add_material.twig');

                //Поля материала
                $fields = MaterialsConsts::getMaterialFields();
                /** @var $field Field */
                foreach ($fields as &$field) { $field->setHtml(); }
                $this->setValue('fields', $fields);

                //Ссылка с формы
                $postUrl = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'Materials','view'=>'Add'));
                $this->setValue('url', $postUrl);

                return $this->render();
                break;
        }

        return false;
    }
}