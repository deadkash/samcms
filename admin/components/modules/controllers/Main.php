<?php

/**
 * Главный контроллер
 *
 * @project SamCMS
 * @package Modules
 * @author Kash
 * @date 25.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class ModulesControllerMain extends Controller {

    /**
     * Представление по умолчанию
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
     * @return mixed|void
     */
    public function execute() {

        //Модель
        $this->setModel('Main');

        //Обработка данных
        $task = Request::getStr('task');
        switch ($task) {

            case 'save':
                $this->save();
                break;

            case 'edit':
                $this->edit();
                break;

            case 'delete':
                $this->delete();
                break;
        }

        //Загружаем представление
        $viewName = Request::getStr('view', $this->defaultView);
        $view = $this->getView($viewName);
        if (!$view) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));

        return $view->display();
    }

    /**
     * Сохраняет модуль
     * @return void
     */
    private function save() {

        //Принимаем основные параметры
        $module = new stdClass();
        $module->title = Request::getStr('title');
        $module->label = Request::getStr('label');
        $module->name = Request::getStr('module');
        $module->active =Request::getInt('active', 0);

        //Принимаем параметры модуля
        $currentModule = $this->model->getExtensionByName($module->name);
        $moduleParameters = json_decode($currentModule->params);
        if ($moduleParameters) {
            foreach ($moduleParameters as &$param) {
                $param->value = Request::getStr('module_'.$param->name, $param->default);
            }
        }

        //Если данные валидны
        $validMainParameters = $this->model->validateMainParameters($module);
        if ($validMainParameters) {

            //Сохраняем основные параметры
            $moduleId = $this->model->saveMainParameters($module);

            //Сохраняем параметры модуля
            $this->model->saveModuleParameters($moduleParameters, $moduleId);

            //Показываем сообщение
            Messages::addMessage('module_add', 'alert-success', Language::translate('modules_msg_module_add'));

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array('id' => $this->itemId));
            $this->router->redirect($redirectUrl);
        }
    }

    /**
     * Обновляет модуль
     * @return void
     */
    public function edit() {

        //Принимаем основные параметры
        $module = new stdClass();
        $module->title = Request::getStr('title');
        $module->id = Request::getInt('module_id');
        $module->label = Request::getStr('label');
        $module->active = Request::getInt('active', 0);

        //Принимаем параметры модуля
        $moduleParameters = $this->model->getModuleParameters($module->id);
        foreach ($moduleParameters as &$parameter) {
            $parameter->value = Request::getStr('module_'.$parameter->name);
        }

        $validMainParameters = $this->model->validateMainParameters($module);
        if ($validMainParameters) {

            //Обновляем основные параметры
            $this->model->updMainParameters($module);

            //Обновляем параметры модуля
            $this->model->updModuleParameters($moduleParameters, $module->id);

            //Показывам сообщение
            Messages::addMessage('module_upd', 'alert-success', Language::translate('modules_msg_module_upd'));

            //Обнуляем кэш модулей
            Cache::invalidate();

            //Редиректим на список
            $redirectUrl = $this->router->getUrl(array('id' => $this->itemId));
            $this->router->redirect($redirectUrl);
        }
    }

    /**
     * Удаляет модули
     * @return void
     */
    public function delete() {

        //Получаем данные
        $items = Request::getPostStr('item');
        if ($items) {
            $result = $this->model->deleteModules($items);
            if ($result) {
                Messages::addMessage('module_delete', 'alert-success', Language::translate('modules_msg_modules_del'));
            }
            else Messages::addMessage('module_del_fail', 'alert-danger', Language::translate('modules_msg_modules_del_fail'));
        }
    }
}