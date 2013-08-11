<?php
/**
 * Модель галереи
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 15.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryModelGallery extends Model {

    /**
     * Конструктор
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Возвращает фотосессию
     * @param $sessionId
     * @return bool|stdClass
     */
    public function getSession($sessionId) {

        $sessionId = (int) $sessionId;
        $query = "SELECT `id`,
                         `title`,
                         `description`
                    FROM `gallery_sessions`
                   WHERE `id`=".$sessionId.";";
        $this->db->setQuery($query);

        return $this->db->getObject();
    }

    /**
     * Возвращает изображения фотосессии
     * @param $sessionId
     * @return array|bool
     */
    public function getImages($sessionId){

        $query = "SELECT `gis`.`path`,
                         `gs`.`name`,
                         `gi`.`title`,
                         `gi`.`description`,
                         `gi`.`id`
                    FROM `gallery_image_sizes` AS `gis`
                    JOIN `gallery_images` AS `gi`
                      ON `gis`.`image_id`=`gi`.`id`
                    JOIN `gallery_sizes` AS `gs`
                      ON `gis`.`size_id`=`gs`.`id`
                   WHERE `gi`.`session_id`=".$sessionId."
                ORDER BY `gi`.`ordering`;";
        $this->db->setQuery($query);

        $images = $this->db->getObjectList();

        $output = array();
        foreach ($images as $image) {
            $output[$image->id]['title'] = $image->title;
            $output[$image->id]['description'] = $image->description;
            $output[$image->id][$image->name] = $image->path;
        }

        return $output;
    }
}