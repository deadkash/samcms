<?php
/**
 * Представление списка
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 09.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryViewList extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name){
        parent::__construct($name);
    }

    /**
     * Отрисовка кода
     * @return string
     */
    public function display(){

        $controller = Request::getStr('controller');
        switch ($controller) {

            case 'session':
                return $this->showSessionList();
                break;

            case 'size':
                return $this->showSizesList();
                break;

            case 'photo':
                return $this->showPhotosList();
                break;

            default:
                return $this->showSessionList();
                break;
        }
    }

    /**
     * Список фотосессий
     * @return string
     */
    private function showSessionList() {

        //Модель и шаблон
        $this->setModel('Session');
        $this->setTemplate('session_list.twig');

        //Список сессий
        $sessions = $this->model->getSessions();
        foreach ($sessions as &$session) {

            //Ссылка на редактирование
            $session->edit = $this->router->getUrl(array(
                'id'=>$this->itemId,'controller'=>'session','view'=>'edit','session_id'=>$session->id));

            //Ссылка на размеры
            $session->sizes = $this->router->getUrl(array(
                'id'=>$this->itemId,'controller'=>'size','view'=>'list','session_id'=>$session->id));

            //Ссылка на фотографии
            $session->photos = $this->router->getUrl(array(
                'id'=>$this->itemId,'controller'=>'photo','view'=>'list','session_id'=>$session->id));
        }
        $this->setValue('sessions', $sessions);

        //Кнопка добавить
        $addLink = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'session','view'=>'add'));
        $this->setValue('add', $addLink);

        return $this->render();
    }

    /**
     * Список размеров галереи
     * @return string
     */
    private function showSizesList() {

        //Модель и шаблон
        $this->setModel('Size');
        $this->setTemplate('size_list.twig');

        //Текущая сессия
        $sessionId = Request::getInt('session_id');

        //Список размеров
        $sizes = $this->model->getSizesBySessionId($sessionId);
        foreach ($sizes as &$size) {
            $size->edit = $this->router->getUrl(array(
                'id'=>$this->itemId,'controller'=>'size','view'=>'edit','session_id'=>$sessionId,'size_id'=>$size->id));
        }
        $this->setValue('sizes', $sizes);

        //Кнопка добавить
        $addLink = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'size','view'=>'add','session_id'=>$sessionId));
        $this->setValue('add', $addLink);

        //Кнопка назад
        $backLink = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'session','view'=>'list'));
        $this->setValue('back', $backLink);

        return $this->render();
    }

    /**
     * Список фотографии галереи
     * @return string
     */
    private function showPhotosList() {

        //Модель и шаблон
        $this->setModel('Photo');
        $this->setTemplate('photo_list.twig');

        //Текущая сессия
        $sessionId = Request::getInt('session_id');

        //Первая и последняя позиция
        $firstPosition = $this->model->getFirstPosition($sessionId);
        $lastPosition = $this->model->getLastPosition($sessionId);

        //Список фотографий
        $images = $this->model->getImagesBySessionId($sessionId);
        foreach ($images as &$image) {

            $image->edit = $this->router->getUrl(array(
                'id'=>$this->itemId,'controller'=>'photo','view'=>'edit','session_id'=>$sessionId,'image_id'=>$image->id
            ));
            $image->edit = $this->router->getUrl(array(
                'id'=>$this->itemId,'controller'=>'photo','view'=>'edit','session_id'=>$sessionId,'image_id'=>$image->id
            ));

            //Если миниатюра пуста
            if (empty($image->path)) $image->path = '/admin/components/gallery/assets/images/260x180.gif';

            $image->disabledUp = ($image->ordering == $firstPosition);
            $image->disabledDown = ($image->ordering == $lastPosition);
        }
        $this->setValue('images', $images);

        //Кнопка добавить
        $addLink = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'photo','view'=>'add','session_id'=>$sessionId));
        $this->setValue('add', $addLink);

        //Кнопка назад
        $backLink = $this->router->getUrl(array(
            'id'=>$this->itemId,'controller'=>'session','view'=>'list'));
        $this->setValue('back', $backLink);

        return $this->render();
    }
}