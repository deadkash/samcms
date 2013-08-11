<?php
/**
 * Страница удачной отправки
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 08.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FormsViewSuccess extends View {

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

        $this->setTemplate('success.twig');
        $this->setModel('Form');

        //Получаем id формы
        $formId = false;
        $data = Parameters::getComponentParameters($this->component, $this->itemId);
        if (isset($data['form_id'])) $formId = (int) $data['form_id'];
        if (!$formId) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section'))));

        //Получаем форму
        $form = $this->model->getFormById($formId);
        $this->setValue('form', $form);

        return $this->render();
    }
}