<?php

/**
 * Представление редактирования модуля
 *
 * @project SamCMS
 * @package Modules
 * @author Kash
 * @date 25.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class ModulesViewEdit extends View {

    /**
     * Конструктор
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Отрисовка html кода
     * @return string
     */
    public function display() {

        //Загружаем модель
        $this->setModel('Main');

        //Текущий модуль
        $moduleId = Request::getInt('module_id');
        $currentModule = $this->model->getModuleById($moduleId);
        $currentModule->module = Language::translate($currentModule->module);
        $this->setValue('module', $currentModule);

        //Параметры модуля
        $moduleParameters = $this->model->getModuleParameters($moduleId);
        foreach ($moduleParameters as &$parameter) {
            $parameter->name = 'module_'.$parameter->name;
            $parameter->default = $parameter->value;
            $parameter->html = Fields::getField($parameter);
            $parameter->title =Language::translate($parameter->title);
        }
        $this->setValue('moduleParameters', $moduleParameters);

        //Ошибка
        $this->setValue('messages', Messages::getMessages());

        //URL отправки формы
        $postUrl = $this->router->getUrl(array('id' => $this->itemId,'module_id' => $moduleId,'view' => 'edit'));
        $this->setValue('url', $postUrl);

        //Ссылка назад
        $this->setValue('back', $this->router->getUrl(array('id' => $this->itemId)));

        $this->setTemplate('edit.twig');

        return $this->render();
    }
}