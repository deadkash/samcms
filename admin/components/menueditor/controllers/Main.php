<?php

/**
 * Контроллер списка меню
 *
 * @project SamCMS
 * @package MenuEditor
 * @author Kash
 * @date 6.02.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MenueditorControllerMain extends Controller {

    /**
     * Действие по умолчанию
     * @var string
     */
    private $defaultView = 'List';

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Запуск контроллера
     * @return mixed|string
     */
    public function execute() {

        //Модель
        $this->setModel('Menu');

        //Движение элементов
        $moveUp = Request::getInt('moveup');
        $moveDown = Request::getInt('movedown');

        if ($moveUp) $this->model->moveUp($moveUp);
        if ($moveDown) $this->model->moveDown($moveDown);

        //Обработка данных
        $task = Request::getStr('task');
        switch ($task) {

            case 'save':
                $this->saveMenu();
                break;

            case 'saveitem':
                $this->saveItem();
                break;

            case 'upditem':
                $this->updItem();
                break;

            case 'delete':
                $this->deleteItems();
                break;
        }

        //Загружаем представление
        $viewName = Request::getStr('view', $this->defaultView);
        $view = $this->getView($viewName);
        if (!$view) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));

        return $view->display();
    }

    /**
     * Сохраняет новое меню
     * @return bool
     */
    private function saveMenu() {

        //Принимаем данные
        $menu = new stdClass();
        $menu->title = Request::getStr('title');
        $menu->id = Request::getStr('menu_id');

        //Если название меню пустое
        if (empty($menu->title)) {

            //Показываем сообщение
            Messages::addMessage(
                'menu_empty_title', 'alert-danger', Language::translate('menueditor_msg_menu_empty_title'));

            //Генерирум ссылку на предыдущую форму
            if ($menu->id) {
                $redirectUrl = $this->router->getUrl(array(
                    'id'        => $this->itemId,
                    'menu_id'   => $menu->id,
                    'view'      => 'edit'
                ));
            }
            else {
                $redirectUrl = $this->router->getUrl(array(
                    'id'    => $this->itemId,
                    'view'  => 'add'
                ));
            }

            //Возвращаем обратно
            Router::redirect($redirectUrl);
        }

        //Добавляем в базу
        $result = $this->model->saveItem($menu);

        //Показываем сообщение
        if ($result) {
            if ($menu->id) {
                Messages::addMessage(
                    'menu_success_upd','alert-success', Language::translate('menueditor_msg_menu_success_upd'));
            }
            else Messages::addMessage(
                'menu_success_add', 'alert-success', Language::translate('menueditor_msg_menu_success_add'));
        }
        else Messages::addMessage('menu_fail_add', 'alert-danger', Language::translate('menueditor_msg_menu_fail_add'));

        return $result;
    }

    /**
     * Удаление элементов
     * @return bool
     */
    private function deleteItems() {

        $result = false;

        //Получаем данные
        $items = Request::getPostStr('item');
        $menuId = Request::getInt('menu_id');

        //Удаляем элементы
        if (!empty($items)) {
            if (empty($menuId)) $result = $this->model->deleteItems($items);
            else $result = $this->model->deleteMenuItems($items);
        }

        //Добавляем сообщение
        if ($result) {
            Messages::addMessage(
                'items_success_delete', 'alert-success', Language::translate('menueditor_msg_menu_success_delete'));
        }
        else Messages::addMessage(
            'items_fail_delete', 'alert-danger', Language::translate('menueditor_msg_meenu_fail_delete'));

        return $result;
    }

    /**
     * Добавление нового элемента
     * @return void
     */
    private function saveItem() {

        //Принимаем основные параметры
        $menuItem = new stdClass();
        $menuId = Request::getInt('menu_id');
        $currentComponent = Request::getStr('component');
        $menuItem->menu_id = $menuId;
        $menuItem->id = false;
        $menuItem->title = Request::getStr('title');
        $menuItem->alias = Request::getStr('alias');
        $menuItem->component = $currentComponent;
        $menuItem->active = Request::getInt('active', 0);
        $menuItem->visible = Request::getInt('visible', 0);
        $menuItem->parent = Request::getInt('main_parent_id');
        $menuItem->ordering = $this->model->getItemLastPosition($menuId, $menuItem->parent) + 1;
        $menuItem->link = Request::getStr('link');

        //Принимаем параметры компонента
        $componentParameters = false;
        $component = $this->model->getComponentByType($currentComponent);
        if ($component) {
            $componentParameters = json_decode($component->params);
            if ($componentParameters) {
                foreach ($componentParameters as &$param) {
                    if ($param->type == 'image') {
                        if (Request::getFile('component_'.$param->name)) {
                            $param->value = Image::upload(Request::getFile('component_'.$param->name),'content');
                        }
                    }
                    else {
                        $param->value = Request::getStr('component_'.$param->name);
                    }
                }
            }
        }

        //Принимаем параметры раздела
        $sectionParameters = MenueditorConsts::getSectionParams();
        foreach ($sectionParameters as &$parameter) {
            $parameter->value = Request::getStr('section_'.$parameter->name);
        }

        //Подготавливаем параметры раздела
        $sectionParameters = $this->model->prepareSectionParameters($sectionParameters, $menuItem->title);

        //Принимаем модули раздела
        $sectionModules = Request::getPostStr('modules');

        //Валидация основных параметров
        $validMainParams = $this->model->validateMainParameters($menuItem);

        if ($validMainParams) {

            //Сохраняем основные параметры
            $menuItemId = $this->model->saveMenuItem($menuItem);

            //Сохраняем параметры компонента
            $this->model->saveComponentParameters($componentParameters, $menuItemId, $currentComponent);

            //Сохраняем параметр раздела
            $this->model->saveSectionParameters($sectionParameters, $menuItemId);

            //Сохраняем модули раздела
            $this->model->saveSectionModules($sectionModules, $menuItemId);

            //Показываем сообщение
            Messages::addMessage(
                'items_add_success', 'alert-success', Language::translate('menueditor_msg_menuitem_success_add'));

            //Редирект на список
            $redirectUrl = $this->router->getUrl(array(
                'id'        => $this->itemId,
                'menu_id'   => $menuId,
                'view'      => 'items'
            ));
            $this->router->redirect($redirectUrl);
        }
    }

    /**
     * Обновление пункта меню
     * @return void
     */
    private function updItem() {

        //Принимаем основные параметры
        $menuItem = new stdClass();

        $menuItem->id       = Request::getInt('main_menu_item_id');
        $menuItem->menu_id  = Request::getInt('main_menu_id');
        $menuItem->title    = Request::getStr('main_title');
        $menuItem->alias    = Request::getStr('main_alias');
        $menuItem->active   = Request::getInt('main_active', 0);
        $menuItem->visible  = Request::getInt('main_visible', 0);
        $menuItem->parent   = Request::getInt('main_parent_id');
        $menuItem->link     = Request::getStr('main_link');

        //Принимаем параметры компонента
        $componentParameters = false;
        $currentItem = $this->model->getMenuItemById($menuItem->id);
        $menuItem->ordering = $currentItem->ordering;
        $component = $this->model->getComponentByType($currentItem->component);
        if ($component) {
            $componentParameters = json_decode($component->params);
            if ($componentParameters) {
                foreach ($componentParameters as $key=>&$param) {
                    if ($param->type == 'image') {
                        $image = Request::getFile('component_'.$param->name);
                        if (!$image['error']) {
                            $param->value = Image::upload($image,'content');
                        }
                        else {
                            unset($componentParameters[$key]);
                        }
                    }
                    else {
                        $param->value = Request::getStr('component_'.$param->name);
                    }
                }
            }
        }

        //Принимаем параметры раздела
        $sectionParameters = MenueditorConsts::getSectionParams();
        foreach ($sectionParameters as &$parameter) {
            $parameter->value = Request::getStr('section_'.$parameter->name);
        }

        $sectionParameters = $this->model->prepareSectionParameters($sectionParameters, $menuItem->title);

        //Принимаем модули раздела
        $sectionModules = Request::getPostStr('modules');

        $validMainParams = $this->model->validateMainParameters($menuItem);

        //Валидация параметров
        if ($validMainParams) {

            //Обновляем основные параметры
            $this->model->updMenuItem($menuItem);

            //Обновляем параметры компонента
            $this->model->updComponentParameters($componentParameters, $menuItem->id, $currentItem->component);

            //Обновляем параметры раздела
            $this->model->updSectionParameters($sectionParameters, $menuItem->id);

            //Сохраняем модули раздела
            $this->model->updSectionModules($sectionModules, $menuItem->id);

            //Показываем сообщение
            Messages::addMessage(
                'items_upd_success', 'alert-success', Language::translate('menueditor_msg_menuitem_success_upd'));

            //Редирект на список
            $redirectUrl = $this->router->getUrl(array(
                'id'        => $this->itemId,
                'menu_id'   => $menuItem->menu_id,
                'view'      => 'items'
            ));
            $this->router->redirect($redirectUrl);
        }
    }
}