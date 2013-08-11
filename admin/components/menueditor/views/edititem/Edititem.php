<?php

/**
 * Представление редактирования пункта меню
 *
 * @project SamCMS
 * @package MenuEditor
 * @author Kash
 * @date 23.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MenueditorViewEdititem extends View {

    /**
     * Конструктор
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Возвращает html код
     * @return string
     */
    public function display() {

        //Загружаем модель
        $this->setModel('Menu');

        //Текущее меню
        $menuId = Request::getInt('menu_id');

        //Пункт меню
        $menuItemId = Request::getInt('menu_item_id');
        $menuItem = $this->model->getMenuItemById($menuItemId);
        $menuItem->component_title = Language::translate($menuItem->component_title);

        //Пункт меню с предыдущей попытки
        $menuItem->menu_id = Request::getInt('main_menu_id', $menuItem->menu_id);
        $menuItem->title = Request::getStr('main_title', $menuItem->title);
        $menuItem->alias = Request::getStr('main_alias', $menuItem->alias);
        $menuItem->active = Request::getInt('main_active', $menuItem->active);
        $menuItem->visible = Request::getInt('main_visible', $menuItem->visible);
        $this->setValue('menuItem', $menuItem);

        //Список доступных меню
        $menuList = $this->model->getMenuList();
        foreach ($menuList as &$menuListItem) {
            $menuListItem->selected = ($menuListItem->id == $menuItem->menu_id);
        }
        $this->setValue('menuList', $menuList);

        //Список разделов
        $parentList = $this->model->getItems($menuId, 0, $menuItemId);
        foreach ($parentList as &$parentListItem) {
            $parentListItem->title = str_pad('', ($parentListItem->level * 2), '--', STR_PAD_LEFT).
                ' '.$parentListItem->title;
            $parentListItem->selected = ($parentListItem->id == $menuItem->parent);
        }
        $this->setValue('parentList', $parentList);

        //Параметры раздела
        $sectionParameters = Parameters::getSectionParameters($menuItemId, true);
        if ($sectionParameters) {
            foreach ($sectionParameters as &$parameter) {
                $parameter->default = $parameter->value;
                $parameter->name = 'section_'.$parameter->name;
                $parameter->default = Request::getStr($parameter->name, $parameter->default);
                $parameter->html = Fields::getField($parameter);
                $parameter->title = Language::translate($parameter->title);
            }
            $this->setValue('section_parameters', $sectionParameters);
        }

        //Параметры компонента
        $componentParameters = $this->model->getComponentParameters($menuItem->component, $menuItemId);
        if ($componentParameters) {
            foreach ($componentParameters as &$parameter) {
                $parameter->name = 'component_'.$parameter->name;
                $parameter->default = $parameter->value;
                $parameter->default = Request::getStr($parameter->name, $parameter->default);
                $parameter->html = Fields::getField($parameter);
                $parameter->title = Language::translate($parameter->title);
            }
            $this->setValue('component_parameters', $componentParameters);
        }

        //Модули раздела
        $sectionModules = $this->model->getModules($menuItemId);
        $this->setValue('sectionModules', $sectionModules);

        //Ошибки
        $this->setValue('messages', Messages::getMessages());

        //Адрес отправки данных с формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'menu_id'=>$menuId,'view'=>'edititem','menu_item_id'=> $menuItemId));
        $this->setValue('url', $postUrl);

        //Устанавливаем шаблон
        $this->setTemplate('edititem.twig');

        return $this->render();
    }
}