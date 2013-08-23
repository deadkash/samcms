<?php

/**
 * Представление создания пользователя
 *
 * @project SamCMS
 * @package Install
 * @author Kash
 * @date 23.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class BuilderViewUser extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name){
        $this->name = $name;
    }

    /**
     * Отрисовка
     * @return string
     */
    public function display(){

        $this->setTemplate('user.twig');
        $this->setModel('Main');

        if (isset($_SESSION['install_language']) &&
            file_exists(ABS_PATH.'install/languages/'.$_SESSION['install_language'].'/'))  {
            Language::setCustomDictionary(ABS_PATH.'install/languages/'.$_SESSION['install_language'].'/');
        }
        $this->setValue('ln', Language::getDictionary('custom'));

        return $this->render();
    }
}