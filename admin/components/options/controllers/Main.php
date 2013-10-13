<?php

/**
 * Главный контроллер
 *
 * @project SamCMS
 * @author Kash
 * @package Options
 * @datet 23.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class OptionsControllerMain extends Controller {

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
     * @return mixed|string
     */
    public function execute() {

        //Модель
        $this->setModel('Options');

        //Обработка данных
        $task = Request::getStr('task');
        switch ($task) {

            case 'save':
                $this->save();
                break;
        }

        //Загружаем представление
        $viewName = Request::getStr('view', $this->defaultView);
        $view = $this->getView($viewName);
        if (!$view) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));

        return $view->display();
    }

    /**
     * Сохраняет параметры
     * @return void
     */
    private function save() {

        $parameters = $this->model->getParams();
        foreach ($parameters as &$parameter) {
            $parameter->value = Request::getStr($parameter->name);
        }

        $this->model->saveParameters($parameters);

        //Показываем сообщение
        Messages::addMessage('options-save', 'alert-success', Language::translate('options_msg_save'));
    }
}