<?php
/**
 * Представление формы
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 08.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FormsViewForm extends View {

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

        //Модель и шаблон
        $this->setModel('Form');
        $this->setTemplate('form.twig');

        //Получаем id формы
        $formId = false;
        $data = Parameters::getComponentParameters($this->component, $this->itemId);
        if (isset($data['form_id'])) $formId = (int) $data['form_id'];
        if (!$formId) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section'))));

        //Получаем форму
        $form = $this->model->getFormById($formId);
        $this->setValue('form', $form);

        //Получаем поля формы
        $fields = $this->model->getFieldsByFormId($formId);
        foreach ($fields as &$field) {
            Fields::setField($field, $field->default);
        }
        $this->setValue('fields', $fields);

        //Адрес отправки формы
        $action = $this->router->getUrl(array('id'=>$this->itemId));
        $this->setValue('action', $action);

        $document = Document::get();
        $document->addCSS('/components/forms/assets/css/style.css');

        return $this->render();
    }
}