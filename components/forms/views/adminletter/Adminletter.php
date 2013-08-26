<?php
/**
 * Представление письма админу
 *
 * @project SamCMS
 * @package Forms
 * @author Kash
 * @date 08.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FormsViewAdminletter extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Отрисовка кода
     * @param bool $fields
     * @return string
     */
    public function display($fields = false) {

        if (!$fields) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section'))));

        $this->setTemplate('letter.twig');
        $this->setValue('fields', $fields);

        return $this->render();
    }
}