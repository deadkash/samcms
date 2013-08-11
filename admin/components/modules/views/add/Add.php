<?php

/**
 * Представление добавления нового модуля
 *
 * @project SamCMS
 * @package Modules
 * @author Kash
 * @date 25.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class ModulesViewAdd extends View {

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
        $type = Request::getStr('type');
        $currentModule = $this->model->getExtensionByName($type);
        $currentModule->title = Language::translate($currentModule->title);
        if (!$currentModule)
            Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));
        $this->setValue('module', $currentModule);

        //Данные с предыдущей отправки
        $this->setValue('title', Request::getStr('title'));
        $this->setValue('label', Request::getStr('label'));

        //Параметры модуля
        $moduleParameters = json_decode($currentModule->params);
        if ($moduleParameters) {
            foreach ($moduleParameters as &$param) {
                $param->name = 'module_'.$param->name;
                $param->default = Request::getStr($param->name, $param->default);
                $param->html = Fields::getField($param);
                $param->title = Language::translate($param->title);
            }
            $this->setValue('moduleParameters', $moduleParameters);
        }

        //Ошибки
        $this->setValue('messages', Messages::getMessages());

        //Url отправки формы
        $postUrl = $this->router->getUrl(array('id' => $this->itemId,'view' => 'add','type' => $type));
        $this->setValue('url', $postUrl);

        //Ссылка назад
        $this->setValue('back', $this->router->getUrl(array('id' => $this->itemId)));

        $this->setTemplate('add.twig');

        return $this->render();
    }
}