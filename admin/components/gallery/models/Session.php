<?php
/**
 * Модель фотосессии
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 09.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryModelSession extends Model {

    /**
     * Конструктор
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Добавляет фотосессию
     * @param $session
     * @return bool
     */
    public function addSession($session){
        return $this->db->insert('gallery_sessions', $session);
    }

    /**
     * Обновляет фотосессию
     * @param $session
     * @return bool
     */
    public function updSession($session) {
        return $this->db->save('gallery_sessions', $session, 'id');
    }

    /**
     * Удаление фотосессий
     * @param $sessions
     * @return bool
     */
    public function deleteSessions($sessions){

        $photoModel = new GalleryModelPhoto();
        foreach ($sessions as $sessionId) {
            $images = $photoModel->getImagesBySessionId($sessionId);
            foreach ($images as $image) {
                $photoModel->delete($image->id);
            }
        }
        $this->db->delete('gallery_sizes', 'session_id', $sessions, 'list');

        return $this->db->delete('gallery_sessions', 'id', $sessions, 'list');
    }

    /**
     * Возвращает список сессий
     * @return array|bool
     */
    public function getSessions(){

        $query = "SELECT `id`,
                         `title`,
                         `description`
                    FROM `gallery_sessions`
                ORDER BY `id`;";
        $this->db->setQuery($query);
        return $this->db->getObjectList();
    }

    /**
     * Возвращает сессию
     * @param $sessionId
     * @return bool|stdClass
     */
    public function getSessionById($sessionId){

        $sessionId = (int) $sessionId;
        $query = "SELECT `id`,
                         `title`,
                         `description`
                    FROM `gallery_sessions`
                   WHERE `id`=".$sessionId.";";
        $this->db->setQuery($query);
        return $this->db->getObject();
    }
}