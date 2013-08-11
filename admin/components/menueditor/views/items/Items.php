<?php

/**
 * Представление списка пунктов меню
 *
 * @project SamCMS
 * @author Kash
 * @package MenuEditor
 * @date 8.02.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MenueditorViewItems extends View {

    /**
     * Конструктор
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Генерирует html код
     * @return string
     */
    public function display() {

        //Загружаем модель
        $this->setModel('Menu');

        //Выбранное меню
        $menuId = Request::getInt('menu_id');

        //Пункты меню
        $items = $this->model->getItems($menuId, 0);
        foreach ($items as &$item) {

            $item->edit = $this->router->getUrl(array(
                'id' => $this->itemId,
                'menu_id' => $menuId,
                'view' => 'edititem',
                'menu_item_id' => $item->id
            ));
            $item->component_title = Language::translate($item->component_title);

            //Первая и последняя позиция
            $firstPosition = $this->model->getItemFirstPosition($menuId, $item->parent);
            $lastPosition = $this->model->getItemLastPosition($menuId, $item->parent);

            $item->disabledUp = ($item->ordering == $firstPosition);
            $item->disabledDown = ($item->ordering == $lastPosition);
            $item->title = str_pad('', ($item->level * 2), '--', STR_PAD_LEFT).' '.$item->title;
        }

        //Типы новых пунктов меню
        $types = $this->model->getItemTypes();
        foreach ($types as &$type) {

            $type->url = $this->router->getUrl(array(
                'id' => $this->itemId,
                'menu_id' => $menuId,
                'view' => 'additem',
                'type' => $type->name
            ));
            $type->title = Language::translate($type->title);
        }

        $this->setValue('menu', $this->model->getMenuById($menuId));
        $this->setValue('items', $items);
        $this->setValue('types', $types);
        $this->setValue('back', $this->router->getUrl(array('id' => $this->itemId)));
        $postUrl =  $this->router->getUrl(array('id' => $this->itemId,'menu_id' => $menuId,'view' => 'items'));
        $this->setValue('url', $postUrl);
        $this->setTemplate('items.twig');

        return $this->render();
    }
}