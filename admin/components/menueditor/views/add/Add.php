<?php

/**
 * Представление добавления меню
 *
 * @project SamCMS
 * @author Kash
 * @package MenuEditor
 * @date 8.02.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MenueditorViewAdd extends View {

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

        if (isset($_SESSION['messages']['menu_empty_title'])) {
            $this->setValue('menu_empty_title', true);
        }
        $this->setValue('url', $this->router->getUrl(array('id'=>$this->itemId)));
        $this->setTemplate('add.twig');
        return $this->render();
    }
}