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

        $this->setTemplate('config.twig');
        $this->setModel('Main');
        $installation = new Installation();

        //Языковые переменные
        $this->setValue('ln', Language::getDictionary('custom'));

        $siteThemes = $installation->getSiteThemes();
        if (!empty($siteThemes)) $this->setValue('siteThemes', $siteThemes);

        $adminThemes = $installation->getAdminThemes();
        if (!empty($adminThemes)) $this->setValue('adminThemes', $adminThemes);

        return $this->render();
    }
}