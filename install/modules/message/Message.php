<?php

/**
 * Модуль вывода системных сообщений
 *
 * @project SamCMS
 * @author Kash
 * @package module
 * @date 22.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Message extends Module {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'message/template.twig';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Имя модуля
     * @var string
     */
    public $name = 'Message';

    /**
     * Отрисовка кода
     * @return string|void
     */
    public function render() {

        //Если есть сообщения
        $messages = Messages::getMessages();

        if ($messages) {

            //Добавляем в шаблон и очищаем
            $this->data['messages'] = $messages;
            Messages::clearAll();
        }

        return parent::render($this->tplPath, $this->data);
    }
}