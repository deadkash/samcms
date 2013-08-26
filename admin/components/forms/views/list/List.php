<?php
/**
 * Список форм
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 02.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FormsViewList extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Отрисовка кода
     * @return string
     */
    public function display() {

        $controller = Request::getStr('controller');
        switch ($controller) {

            case 'forms':
                return $this->showForms();
                break;

            case 'fields':
                return $this->showFields();
                break;

            default:
                return $this->showForms();
                break;
        }
    }

    /**
     * Список форм
     * @return string
     */
    private function showForms() {

        //Установка шаблона и модели
        $this->setTemplate('forms.twig');
        $this->setModel('Form');

        //Адрес отправки формы
        $postUrl = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'forms','view'=>'list'));
        $this->setValue('url',$postUrl);

        //Добавление новой формы
        $addLink = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'forms','view'=>'add'));
        $this->setValue('add', $addLink);

        //Список форм
        $forms = $this->model->getForms();
        if (!empty($forms)) {
            foreach ($forms as &$form) {
                $form->edit = $this->router->getUrl(array(
                    'id'=>$this->itemId,'controller'=>'forms','view'=>'edit','form_id'=>$form->id));
                $form->fields = $this->router->getUrl(array(
                    'id'=>$this->itemId,'controller'=> 'fields','view'=>'list','form_id'=>$form->id));
            }
            $this->setValue('forms', $forms);
        }

        return $this->render();
    }

    /**
     * Список полей
     * @return string
     */
    private function showFields() {

        //Установка шаблона и модели
        $this->setTemplate('fields.twig');
        $this->setModel('Field');

        //Текущая форма
        $formId = Request::getInt('form_id');
        $form = $this->getModel('form')->getFormById($formId);
        $this->setValue('form', $form);

        //Поля формы
        $fields = $this->model->getFieldsByFormId($formId);
        foreach ($fields as &$field) {
            $field->edit = $this->router->getUrl(array(
                'id'=>$this->itemId,'controller'=>'fields','view'=>'edit','form_id'=>$formId,'field_id'=>$field->id
            ));

            //Первая и последняя позиция
            $firstPosition = $this->model->getFirstPosition($field->form_id);
            $lastPosition = $this->model->getLastPosition($field->form_id);

            $field->disabledUp = ($field->ordering == $firstPosition);
            $field->disabledDown = ($field->ordering == $lastPosition);
        }
        $this->setValue('fields', $fields);

        //Адрес отправки формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'fields','view'=>'list','form_id'=>$formId));
        $this->setValue('url',$postUrl);

        //Добавление новой формы
        $addLink = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'fields','view'=>'add','form_id'=>$formId));
        $this->setValue('add', $addLink);

        //Ссылка назад
        $backLink = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'forms','view'=>'list'));
        $this->setValue('back', $backLink);

        return $this->render();
    }
}