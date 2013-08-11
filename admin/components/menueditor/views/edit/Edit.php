<?php

/**
 * Представление редактирования меню
 *
 * @project SamCMS
 * @author Kash
 * @package MenuEditor
 * @date 8.02.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MenueditorViewEdit extends View {

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
        $this->setModel('Menu');

        //ID меню
        $menuId = Request::getInt('menu_id');
        if (!$menuId) {
            Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));
        }
        $menu = $this->model->getMenuById($menuId);
        if (!$menu) {
            Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));
        }

        if (isset($_SESSION['messages']['menu_empty_title'])) {
            $this->setValue('menu_empty_title', true);
        }

        $this->setValue('menu', $menu);
        $this->setValue('url', $this->router->getUrl(array('id'=>$this->itemId)));
        $this->setTemplate('edit.twig');

        return $this->render();
    }
}