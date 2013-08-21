<?php

/**
 * Представление приветствия
 *
 * @project SamCMS
 * @package Install
 * @author Kash
 * @date 21.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class BuilderViewWelcome extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name){
        $this->name = $name;
    }

    /**
     * Отрисовка кода
     * @return string
     */
    public function display() {

        $this->setTemplate('welcome.twig');
        $this->setModel('Main');

        $languages = $this->model->getLanguages();
        $this->setValue('languages', $languages);

        return $this->render();
    }
}