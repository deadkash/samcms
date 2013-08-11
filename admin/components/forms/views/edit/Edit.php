<?php
/**
 * Редактирование формы
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 06.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FormsViewEdit extends View {

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
                return $this->showFormEdit();
                break;

            case 'fields';
                return $this->showFieldEdit();
                break;

            default:
                return $this->showFormEdit();
                break;
        }
    }

    /**
     * Редактирование формы
     * @return string
     */
    private function showFormEdit() {

        //Установка модели и шаблона
        $this->setModel('Form');
        $this->setTemplate('edit_form.twig');

        //Загружаем форму
        $formId = Request::getInt('form_id');
        $form = $this->model->getFormById($formId);
        $this->setValue('form_id', $formId);

        //Поля формы
        $fields = FormsConsts::getFormFields();
        foreach ($fields as &$field) {
            /** @var Field $field */
            $fieldName = $field->name;
            $field->default = $form->$fieldName;
            $field->setHtml();
        }
        $this->setValue('fields', $fields);

        //Ошибки
        $this->setValue('errors', Messages::getMessages());

        //Ссылка с формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'forms','view'=>'edit','form_id'=>$formId));
        $this->setValue('url', $postUrl);

        return $this->render();
    }

    /**
     * Редактирование поля
     * @return string
     */
    private function showFieldEdit() {

        //Установка модели и шаблона
        $this->setModel('Field');
        $this->setTemplate('edit_field.twig');

        //Текущая форма
        $formId = Request::getInt('form_id');

        //Загружаем поле
        $fieldId = Request::getInt('field_id');
        $formField = $this->model->getFieldById($fieldId);
        $this->setValue('field_id', $fieldId);

        //Поля формы
        $fields = FormsConsts::getFieldFields();
        foreach ($fields as &$field) {
            /** @var Field $field */
            $fieldName = $field->name;
            $field->default = $formField->$fieldName;
            $field->setHtml();
        }
        $this->setValue('fields', $fields);

        //Ошибки
        $this->setValue('errors', Messages::getMessages());

        //Ссылка с формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'fields','view'=>'edit','form_id'=>$formId,'field_id'=>$fieldId));
        $this->setValue('url', $postUrl);

        return $this->render();
    }
}