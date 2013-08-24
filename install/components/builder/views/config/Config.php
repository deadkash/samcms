<?php

/**
 * Представление создания конфигурации
 *
 * @project SamCMS
 * @package Install
 * @author Kash
 * @date 23.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class BuilderViewConfig extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name){
        $this->name = $name;
    }

    /**
     * Отрисовка html
     * @return string
     */
    public function display(){

        $installation = new Installation();
        if ($installation->issetConfig()) {
            Router::redirect('/install/?view=user');
        }

        $this->setTemplate('config.twig');
        $this->setModel('Main');

        //Языковые переменные
        $this->setValue('ln', Language::getDictionary('custom'));

        //Поля формы
        $dbFields = BuilderConsts::getDBFields();
        /** @var $field Field */
        foreach ($dbFields as &$field) {
            $field->setHtml();
        }
        $this->setValue('dbFields', $dbFields);

        //Контейнер сообщений
        $message = new Message();
        $this->setValue('messages', $message->render());

        $siteThemes = $installation->getSiteThemes();
        if (!empty($siteThemes)) $this->setValue('siteThemes', $siteThemes);

        $adminThemes = $installation->getAdminThemes();
        if (!empty($adminThemes)) $this->setValue('adminThemes', $adminThemes);

        return $this->render();
    }
}