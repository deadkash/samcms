<?php
/**
 * Контроллер галереи
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 15.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryControllerGallery extends Controller {

    /**
     * Представление по умолчанию
     * @var string
     */
    private $defaultView = 'Images';

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

        //Загружаем представление
        $view = $this->getView($this->defaultView);
        return $view->display();
    }
}