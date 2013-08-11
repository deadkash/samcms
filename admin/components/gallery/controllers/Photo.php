<?php
/**
 * Контроллер фотографий
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 15.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryControllerPhoto extends Controller {

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

        //Загружаем модель
        $this->setModel('Photo');

        //Удаление
        $delete = Request::getInt('delete');
        if ($delete) $this->model->delete($delete);

        //Движение элементов
        $moveLeft = Request::getInt('moveLeft');
        $moveRight = Request::getInt('moveRight');

        if ($moveLeft) $this->model->moveLeft($moveLeft);
        if ($moveRight) $this->model->moveRight($moveRight);

        //Обработка данных
        $task = Request::getStr('task');
        switch ($task) {

            case 'upload':
                $this->upload();
                break;

            case 'update':
                $this->update();
                break;

            case 'resize':
                $this->resize();
                break;
        }

        //Загружаем представление
        $viewName = Request::getStr('view', $this->defaultView);
        $view = $this->getView($viewName);
        if (!$view) Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));

        return $view->display();
    }

    /**
     * Добавляет фотографию
     * @return void
     */
    private function upload() {

        //Принимаем данные
        $image = new stdClass();
        $image->session_id = Request::getInt('session_id');
        $fields = GalleryConsts::getPhotoFields();
        foreach ($fields as &$field) {
            $fieldName = $field->name;
            $image->$fieldName = Request::getStr($fieldName);
            if ($field->type == 'image') {
                $image->$fieldName = Request::getFile($fieldName);
            }
            $field->value = $image->$fieldName;
        }

        //Если данные валидны
        $valid = Fields::validate($fields);
        if ($valid) {

            //Загружаем оригинальное изображение
            $imageId = $this->model->uploadPhoto($image);

            //Редиректим на обработку
            $redirectUrl = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'photo',
                'view' => 'resize',
                'session_id' => Request::getInt('session_id'),
                'image_id' => $imageId
            ));
            $this->router->redirect($redirectUrl);
        }
        else {

            //Добавляет сообщения
            Fields::setMessages($fields, $this->component);
            Fields::setErrors($fields);
        }
    }

    /**
     * Обновление фотографии
     * @return void
     */
    private function update() {

        //Принимаем данные
        $image = new stdClass();
        $image->id = Request::getInt('image_id');
        $sessionId = Request::getInt('session_id');
        $fields = GalleryConsts::getPhotoFields();
        foreach ($fields as $key => &$field) {

            $fieldName = $field->name;
            $image->$fieldName = Request::getStr($fieldName);
            if ($field->type == 'image') {
                $image->$fieldName = Request::getFile($fieldName);
            }

            $field->value = $image->$fieldName;

            //Если изображение не было загружено, то и не трогаем его
            if ($field->type == 'image' && empty($field->value['tmp_name'])) {
                unset($image->$fieldName);
                unset($fields[$key]);
            }
        }

        //Если данные валидны
        $valid = Fields::validate($fields);
        if ($valid) {

            $this->model->updPhoto($image);

            //Если была загружена фотка, то ресайзим
            if (isset($image->image) && !empty($image->image)) {

                //Редиректим на обработку
                $redirectUrl = $this->router->getUrl(array(
                    'id' => $this->itemId,
                    'controller' => 'photo',
                    'view' => 'resize',
                    'session_id' => $sessionId,
                    'image_id' => $image->id
                ));
                $this->router->redirect($redirectUrl);
            }
            else {

                //Добавляем сообщение
                Messages::addMessage('photo_upd', 'alert-success', Language::translate('gallery_msg_photo_upd'));

                //Редиректим на список
                $redirectUrl = $this->router->getUrl(array(
                    'id' => $this->itemId,
                    'controller' => 'photo',
                    'view' => 'list',
                    'session_id' => $sessionId
                ));
                $this->router->redirect($redirectUrl);
            }
        }
        else {

            //Добавляет сообщения
            Fields::setMessages($fields, $this->component);
            Fields::setErrors($fields);
        }
    }

    /**
     * Редактирование размеров
     * @return void
     */
    private function resize() {

        //Получаем размеры
        $sessionId = Request::getInt('session_id');
        $sizes = $this->getModel('size')->getSizesBySessionId($sessionId);

        //Добавляем размер по умолчанию
        $sizes[] = GalleryConsts::getDefaultSize($sessionId);

        foreach ($sizes as &$size) {

            //Результаты кроппинга
            $size->x = Request::getInt('size_'.$size->id.'_x');
            $size->y = Request::getInt('size_'.$size->id.'_y');
            $size->w = Request::getInt('size_'.$size->id.'_w');
            $size->h = Request::getInt('size_'.$size->id.'_h');
            $size->ow = Request::getInt('size_'.$size->id.'_ow');
            $size->oh = Request::getInt('size_'.$size->id.'_oh');
        }

        //Отправляем на ресайз
        $imageId = Request::getInt('image_id');
        $this->model->resizeImage($imageId, $sizes);

        //Добавляем сообщение
        Messages::addMessage('size_add', 'alert-success', Language::translate('gallery_msg_photo_add'));

        //Редиректим на список
        $redirectUrl = $this->router->getUrl(array(
            'id' => $this->itemId,
            'controller' => 'photo',
            'view' => 'list',
            'session_id' => Request::getInt('session_id'),
        ));
        $this->router->redirect($redirectUrl);
    }
}