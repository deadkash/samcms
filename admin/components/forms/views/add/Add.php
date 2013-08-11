<?php
/**
 * Добавление новой формы
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 02.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FormsViewAdd extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Отрисовка html кода
     * @return string
     */
    public function display() {

        $controller = Request::getStr('controller');
        switch ($controller) {

            case 'forms':
                return $this->showAddForm();
                break;

            case 'fields':
                return $this->showAddField();
                break;

            default:
                return $this->showAddForm();
                break;
        }
    }

    /**
     * Добавление формы
     * @return string
     */
    private function showAddForm() {

        //Модель и шаблон
        $this->setModel('Form');
        $this->setTemplate('add_form.twig');

        //Поля формы
        $fields = FormsConsts::getFormFields();
        /** @var $field Field */
        foreach ($fields as &$field) {
            $field->setHtml();
        }
        $this->setValue('fields', $fields);

        //Ссылка с формы
        $postUrl = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'forms','view'=>'add'));
        $this->setValue('url', $postUrl);

        return $this->render();
    }

    /**
     * Добавление поля
     * @return string
     */
    private function showAddField() {

        //Модель и шаблон
        $this->setModel('Field');
        $this->setTemplate('add_field.twig');

        //Текущая форма
        $formId = Request::getInt('form_id');

        //Поля поля :)
        $fields = FormsConsts::getFieldFields();
        /** @var $field Field */
        foreach ($fields as &$field) {
            $field->setHtml();
        }
        $this->setValue('fields', $fields);

        //Ссылка с формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'fields','view'=>'add','form_id'=>$formId));
        $this->setValue('url', $postUrl);

        return $this->render();
    }
}