<?php

/**
 * Представление добавления пункта меню
 *
 * @project SamCMS
 * @author Kash
 * @package MenuEditor
 * @date 30.03.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MenueditorViewAdditem extends View {

    /**
     * Конструктор
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Возвращает html-код
     * @return string
     */
    public function display() {

        //Загружаем меню
        $this->setModel('Menu');

        //Текущее меню
        $menuId = Request::getInt('menu_id');
        $menu = $this->model->getMenuById($menuId);
        $this->setValue('menu', $menu);

        //Пункт меню с предыдущей попытки
        $menuItem = new stdClass();
        $menuItem->title = Request::getStr('title');
        $menuItem->alias = Request::getStr('alias');
        $this->setValue('menuItem', $menuItem);

        //Ошибки
        $this->setValue('messages', Messages::getMessages());

        //Компонент пункта меню
        $itemType = Request::getStr('type');
        $this->setValue('component', $itemType);
        $component = $this->model->getComponentByType($itemType);
        if (empty($component)) {
            Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));
        }

        //Список разделов
        $parentList = $this->model->getItems($menuId, 0);
        foreach ($parentList as &$parentListItem) {
            $parentListItem->title = str_pad('', ($parentListItem->level * 2), '--', STR_PAD_LEFT).
                ' '.$parentListItem->title;
        }
        $this->setValue('parentList', $parentList);

        //Параметры компонента
        $componentParameters = json_decode($component->params);
        if ($componentParameters) {
            foreach ($componentParameters as &$param) {
                $param->name = 'component_'.$param->name;
                $param->default = Request::getStr($param->name, $param->default);
                $param->html = Fields::getField($param);
                $param->title = Language::translate($param->title);
            }
            $this->setValue('componentParameters', $componentParameters);
        }

        //Параметры раздела
        $sectionParameters = MenueditorConsts::getSectionParams();
        foreach ($sectionParameters as &$parameter) {
            /** @var $parameter Field */
            $parameter->name = 'section_'.$parameter->name;
            $parameter->default = Request::getStr($parameter->name, $parameter->default);
            $parameter->setHtml();
        }
        $this->setValue('sectionParameters', $sectionParameters);

        //Модули раздела
        $sectionModules = $this->model->getModules();
        $this->setValue('sectionModules', $sectionModules);

        //Адрес отправки данных с формы
        $postUrl = $this->router->getUrl(array(
            'id'=>$this->itemId,'menu_id'=>$menuId,'view'=>'additem','type'=>$itemType));
        $this->setValue('url', $postUrl);

        //Устанавливаем шаблон
        $this->setTemplate('additem.twig');

        return $this->render();
    }
}