<?php
/**
 * Модуль слайдера
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 16.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Slider extends Module {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'slider/templates/default.twig';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Имя модуля
     * @var string
     */
    public $name = 'Slider';

    /**
     * Отрисовка html кода
     * @return string
     */
    public function render() {

        //Стили и скрипты модуля
        $document = Document::get();
        $document->addJS('/lib/bjqs/bjqs-1.3.min.js');
        $document->addJS('/modules/slider/assets/js/slider-init.js');
        $document->addCSS('/lib/bjqs/bjqs.css');

        //Если есть в кэше
        if ($html = Cache::get($this, $this->cacheTime)) return $html;

        $parameters = Parameters::getModuleParametersByLabel($this->label, $this->name, $this->itemId);
        $sessionId = $parameters['session_id'];
        $images = $this->getImages($sessionId);
        $this->data['slides'] = $images;

        return parent::render();
    }

    /**
     * Возвращает изображения
     * @param $sessionId
     * @return array
     */
    private function getImages($sessionId) {

        $db = DB::create();
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
        $db->setQuery($query);

        $images = $db->getObjectList();

        $output = array();
        $first = true;
        foreach ($images as $image) {
            $output[$image->id]['title'] = $image->title;
            $output[$image->id]['description'] = $image->description;
            $output[$image->id][$image->name] = $image->path;
            if ($first) {
                $output[$image->id]['first'] = true;
                $first = false;
            }
        }

        return $output;
    }
}