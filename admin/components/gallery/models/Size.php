<?php
/**
 * Модель размеров галереи
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 15.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryModelSize extends Model {

    /**
     * Конструктор
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Возвращает список размеров фотосессии
     * @param $sessionId
     * @return array|bool
     */
    public function getSizesBySessionId($sessionId) {

        $sessionId = (int) $sessionId;
        $query = "SELECT `id`,
                         `title`,
                         `name`,
                         `width`,
                         `height`,
                         `session_id`
                    FROM `gallery_sizes`
                   WHERE `session_id`=".$sessionId.";";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает размер по id
     * @param $sizeId
     * @return bool|stdClass
     */
    public function getSizeById($sizeId) {

        $sizeId = (int) $sizeId;
        $query = "SELECT `id`,
                         `session_id`,
                         `title`,
                         `name`,
                         `width`,
                         `height`
                    FROM `gallery_sizes`
                   WHERE `id`=".$sizeId.";";
        $this->db->setQuery($query);
        return $this->db->getObject();
    }

    /**
     * Добавляет новый размер
     * @param $size
     * @return bool
     */
    public function addSize($size) {
        return $this->db->insert('gallery_sizes', $size);
    }

    /**
     * Обновляет размер
     * @param $size
     * @return bool
     */
    public function updSize($size) {
        return $this->db->save('gallery_sizes', $size, 'id');
    }

    /**
     * Удаляет размеры
     * @param $sizes
     * @return bool
     */
    public function delete($sizes) {
        return $this->db->delete('gallery_sizes', 'id', $sizes, 'list');
    }
}