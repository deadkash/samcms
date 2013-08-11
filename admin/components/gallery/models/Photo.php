<?php
/**
 * Модель фотографии
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 15.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryModelPhoto extends Model {

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Добавляет фото
     * @param $photo
     * @return int
     */
    public function uploadPhoto($photo) {

        $sessionId = $photo->session_id;

        //Добавление фотографии
        $image = new stdClass();
        $image->session_id = $sessionId;
        $image->title = $photo->title;
        $image->description = $photo->description;
        $image->ordering = $this->getLastPosition($sessionId) + 1;
        $image->name = $photo->image['name'];
        $image->image = Image::upload($photo->image, $sessionId);

       return $this->db->insert('gallery_images', $image);
    }

    /**
     * Обновляет фото
     * @param $photo
     * @return bool
     */
    public function updPhoto($photo) {

        if (isset($photo->image) && !empty($photo->image)) {
            $photo->image = Image::upload($photo->image, $photo->session_id);
        }

        return $this->db->save('gallery_images', $photo, 'id');
    }

    /**
     * Отрезает изображения по размерам
     * @param $imageId
     * @param $sizes
     */
    public function resizeImage($imageId, $sizes) {

        $this->resetSizes($imageId);
        $image = $this->getImageById($imageId);

        foreach ($sizes as $size) {

            $imagesize = new stdClass();
            $imagesize->image_id = $image->id;
            $imagesize->size_id = $size->id;
            $imagesize->path = Image::resize($image, $size, $image->session_id, $size->name);

            $this->db->insert('gallery_image_sizes', $imagesize);
        }
    }

    /**
     * Удаляет отрезанные изображения
     * @param $imageId
     */
    private function resetSizes($imageId) {

        $imageId = (int) $imageId;
        $query = "SELECT `path`
                    FROM `gallery_image_sizes`
                   WHERE `image_id`=".$imageId.";";
        $this->db->setQuery($query);

        $images = $this->db->getObjectList();
        foreach ($images as $image) {
            if (file_exists($image->path)) {
                unlink($image->path);
            }
        }

        $this->db->delete('gallery_image_sizes', 'image_id', $imageId);
    }

    /**
     * Возвращает список фоток
     * @param $sessionId
     * @return array|bool
     */
    public function getImagesBySessionId($sessionId) {

        $sessionId = (int) $sessionId;
        $query = "SELECT `gi`.`id`,
                         `gi`.`session_id`,
                         `gi`.`title`,
                         `gi`.`ordering`,
                         `gis`.`path`
                    FROM `gallery_images` AS `gi`
               LEFT JOIN `gallery_image_sizes` AS `gis`
                      ON `gis`.`image_id`=`gi`.`id` AND `gis`.`size_id`=0
                   WHERE `gi`.`session_id`=".$sessionId."
                ORDER BY `gi`.`ordering`;";
        $this->db->setQuery($query);
        return $this->db->getObjectList();
    }

    /**
     * Возвращает изображение по id
     * @param $imageId
     * @return bool|stdClass
     */
    public function getImageById($imageId) {

        $imageId = (int) $imageId;
        $query = "SELECT `id`,
                         `session_id`,
                         `title`,
                         `description`,
                         `name`,
                         `image`,
                         `ordering`
                    FROM `gallery_images`
                   WHERE `id`=".$imageId.";";
        $this->db->setQuery($query);
        return $this->db->getObject();
    }

    /**
     * Удаление фотографии
     * @param $imageId
     */
    public function delete($imageId) {

        $imageId = (int) $imageId;
        $query = "SELECT `path`
                    FROM `gallery_image_sizes`
                   WHERE `image_id`=".$imageId.";";
        $this->db->setQuery($query);
        $images = $this->db->getObjectList();
        foreach ($images as $image) {
            if (file_exists(ABS_PATH.$image->path)) {
                unlink(ABS_PATH.$image->path);
            }
        }

        $image = $this->getImageById($imageId);

        if (file_exists(ABS_PATH.$image->image) && is_file(ABS_PATH.$image->image)) {
            unlink(ABS_PATH.$image->image);
        }

        $this->db->delete('gallery_image_sizes', 'image_id', $imageId);
        $this->db->delete('gallery_images', 'id', $imageId);
    }

    /**
     * Возвращает последнюю позицию
     * @param $sessionId
     * @return int
     */
    public function getLastPosition($sessionId) {

        $sessionId = (int) $sessionId;
        $query = "SELECT MAX(`ordering`) AS `position`
                    FROM `gallery_images`
                   WHERE `session_id`=".$sessionId.";";
        $this->db->setQuery($query);

        $image = $this->db->getObject();
        if (isset($image->position)) return $image->position;
        else return 0;
    }

    /**
     * Возвращает первую позицию в форме
     * @param $sessionId
     * @return mixed
     */
    public function getFirstPosition($sessionId) {

        $sessionId = (int) $sessionId;
        $query = "SELECT MIN(`ordering`) AS `position`
                    FROM `gallery_images`
                   WHERE `session_id`=".$sessionId.";";
        $this->db->setQuery($query);

        return $this->db->getObject()->position;
    }

    /**
     * Поднимаем элемент влево
     * @param $imageId
     */
    public function moveLeft($imageId) {

        $imageId = (int) $imageId;
        $image = $this->getImageById($imageId);

        //Если еще не первый, то двигаем
        if ($image->ordering != $this->getFirstPosition($image->session_id)) {

            //Находим id предыдущего элемента
            $query = "SELECT `id`,
                             `ordering`
                        FROM `gallery_images`
                       WHERE `session_id`=".$image->session_id." AND `ordering`<".$image->ordering."
                    ORDER BY `ordering` DESC
                       LIMIT 1";
            $this->db->setQuery($query);
            $prevItem = $this->db->getObject();

            //Задаем ему порядок текущего элемента
            $query = "UPDATE `gallery_images`
                         SET `ordering`=".$image->ordering."
                       WHERE `id`=".$prevItem->id.";";
            $this->db->query($query);

            //А текущему задаем порядок предыдущего
            $query = "UPDATE `gallery_images`
                         SET `ordering`=".$prevItem->ordering."
                       WHERE `id`=".$imageId.";";
            $this->db->query($query);
        }
    }

    /**
     * Опускает элемент вправо
     * @param $imageId
     */
    public function moveRight($imageId) {

        $imageId = (int) $imageId;
        $image = $this->getImageById($imageId);

        if ($image->ordering != $this->getLastPosition($image->session_id)) {

            //Находим id следующего элемента
            $query = "SELECT `id`,
                             `ordering`
                        FROM `gallery_images`
                       WHERE `session_id`=".$image->session_id." AND `ordering`>".$image->ordering."
                    ORDER BY `ordering` ASC
                       LIMIT 1";
            $this->db->setQuery($query);
            $nextItem = $this->db->getObject();

            //Задаем ему порядок текущего элемента
            $query = "UPDATE `gallery_images`
                         SET `ordering`=".$image->ordering."
                       WHERE `id`=".$nextItem->id.";";
            $this->db->query($query);

            //А текущему задаем порядок следующего
            $query = "UPDATE `gallery_images`
                         SET `ordering`=".$nextItem->ordering."
                       WHERE `id`=".$imageId.";";
            $this->db->query($query);
        }
    }
}