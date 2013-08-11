<?php
/**
 * Контроллер материалов
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 11.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class MaterialsControllerMain extends Controller {

    /**
     * Представление по умолчанию
     * @var string
     */
    private $defaultView = 'List';

    /**
     * Конструктор
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Запуск контроллера
     * @return mixed
     */
    public function execute(){

        //Загружаем модель
        $this->setModel('Main');

        //Загружаем представление
        $materialId = Request::getInt('material_id');
        if ($materialId) $this->defaultView = 'Detail';

        $viewName = Request::getStr('view', $this->defaultView);
        $view = $this->getView($viewName);
        if (!$view) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section'))));

        return $view->display();
    }
}