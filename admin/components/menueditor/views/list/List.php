<?php

/**
 * Представление списка меню
 *
 * @project SamCMS
 * @package MenuEditor
 * @author Kash
 * @date 8.02.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MenueditorViewList extends View {

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

        //Загружаем меню
        $this->setModel('Menu');

        //Список
        $menus = $this->model->getMenuList();
        foreach ($menus as &$menu) {

            //Ссылка на редактирование
            $menu->edit = $this->router->getUrl(array(
                'id' => $this->itemId,
                'menu_id' => $menu->id,
                'view' => 'edit'
            ));

            //Ссылка на пункты меню
            $menu->items = $this->router->getUrl(array(
                'id' => $this->itemId,
                'menu_id' => $menu->id,
                'view' => 'items'
            ));
        }

        $this->setValue('items', $menus);
        $this->setValue('add', $this->router->getUrl(array('id' => $this->itemId, 'view' => 'add')));
        $this->setValue('url', $this->router->getUrl(array('id' => $this->itemId)));
        $this->setTemplate('list.twig');

        return $this->render();
    }
}