<?php

/**
 * Представление списка
 *
 * @project SamCMS
 * @package Modules
 * @author Kash
 * @date 25.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class ModulesViewList extends View {

    /** @var int Количество на страницу */
    private $onPage = 10;

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

        //Типы новых модулей
        $types = $this->model->getModulesTypes();
        foreach ($types as &$type) {
            $type->url = $this->router->getUrl(array('id' => $this->itemId, 'view' => 'add', 'type' => $type->name));
            $type->title = Language::translate($type->title);
        }
        $this->setValue('types', $types);

        //Страница
        $page = Request::getInt('page');
        if ($page) $page--;

        //Список модулей
        $modules = $this->model->getModules($page, $this->onPage);
        $count = $this->model->getModulesCount();
        foreach ($modules as &$module) {
            $module->edit = $this->router->getUrl(array(
                'id' => $this->itemId,
                'module_id' => $module->id,
                'view' => 'edit'
            ));
            $module->module = Language::translate($module->module);
        }
        $this->setValue('modules', $modules);

        //Страницы
        $params = array('view' => 'list');
        $pages = $this->model->getPageLine($page, $count, $this->onPage, $params);
        if ($pages) {
            $this->setValue('pages', $pages);
        }

        $this->setValue('url', $this->router->getUrl(array('id' => $this->itemId)));
        $this->setTemplate('list.twig');

        return $this->render();
    }
}