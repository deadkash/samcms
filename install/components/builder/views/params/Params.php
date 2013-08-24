<?php
/**
 * Представление редактирования параметров
 *
 * @project SamCMS
 * @package Install
 * @author Kash
 * @date 24.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class BuilderViewParams extends View {

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
    public function display(){

        $this->setTemplate('params.twig');
        $this->setModel('Main');

        //Языковые переменные
        $this->setValue('ln', Language::getDictionary('custom'));

        //Поля формы
        $fields = BuilderConsts::getParamsFields();
        /** @var $field Field */
        foreach ($fields as &$field) {
            $field->setHtml();
        }
        $this->setValue('fields', $fields);

        //Контейнер сообщений
        $message = new Message();
        $this->setValue('messages', $message->render());

        return $this->render();
    }
}