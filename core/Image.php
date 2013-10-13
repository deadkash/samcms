<?php
/**
 * Изображения
 *
 * @project SamCMS
 * @package Core
 * @author Kash
 * @date 15.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Image extends Core {

    /** Константы типов изображений */
    const TYPE_GIF = 1;
    const TYPE_JPEG = 2;
    const TYPE_PNG = 3;

    /**
     * Подгоняет размер изображения
     * @param $image mixed Объект изображения
     * @param $size mixed Объект размера
     * @param $sessionId int ID фотосессии
     * @param $sizeName string Имя размера
     * @return bool|string
     */
    public static function resize($image, $size, $sessionId, $sizeName) {

        $pathToImage = ABS_PATH.$image->image;
        list($realWidth, $realHeight, $type) = getimagesize($pathToImage);

        //Если не задана ширина
        if (empty($size->width)) {
            $size->width = round($realWidth * $size->height / $realHeight);
        }

        //Если не задана высота
        if (empty($size->height)) {
            $size->height = round($realHeight * $size->width / $realWidth);
        }

        //Определение путей
        $dirPath = ABS_PATH.'uploads/gallery/';
        $sessionDirPath = $dirPath.(string) $sessionId.'/';
        $sizeDirPath = $sessionDirPath.(string) $sizeName.'/';

        //Создаем папку, если нужно
        if (!file_exists($sizeDirPath)) {
            $result = @mkdir($sizeDirPath, 0777, true);
            if (!$result) return false;
        }

        //Определяем с именем файла
        $imageName = $image->name;
        $imageExt = substr($imageName, strrpos($imageName, '.'));
        $imageTitle = substr($imageName, 0, strrpos($imageName, '.'));
        $imageNewTitle = (string) $sessionId.'_'.(string) $sizeName.'_'.Translate::convert(Translate::translit($imageTitle));
        $imageNewPath = $sizeDirPath.$imageNewTitle.$imageExt;

        //Если файл уже существует
        if (file_exists($imageNewPath)) {
            $imageNewPath = $sizeDirPath.$imageNewTitle.time().$imageExt;
        }

        //Создаем пустое изображение
        $blankImage = imagecreatetruecolor($size->width, $size->height);

        //Т.к. при обрезании изображения оригинальное изображение уменьшено, то приходиться корректировать координаты
        $size->x = round(($realWidth * $size->x) / $size->ow);
        $size->y = round(($realHeight * $size->y) / $size->oh);
        $size->w = round($size->w * ($realWidth / $size->ow));
        $size->h = round($size->h * ($realHeight / $size->oh));

        switch ($type){

            case self::TYPE_GIF:

                $image = imagecreatefromgif($pathToImage);
                imagecolortransparent($blankImage, imagecolorallocate($blankImage, 0, 0, 0));
                imagealphablending($blankImage, false);
                imagesavealpha($blankImage, true);
                imagecopyresampled($blankImage,$image,0,0,$size->x,$size->y,$size->width,$size->height,$size->w,$size->h);
                imagegif($blankImage, $imageNewPath);
                break;

            case self::TYPE_JPEG:

                $image = imagecreatefromjpeg($pathToImage);
                imagecopyresampled($blankImage,$image,0,0,$size->x,$size->y,$size->width,$size->height,$size->w,$size->h);
                imagejpeg($blankImage, $imageNewPath);
                break;

            case self::TYPE_PNG:

                $image = imagecreatefrompng($pathToImage);
                imagecolortransparent($blankImage, imagecolorallocate($blankImage, 0, 0, 0));
                imagealphablending($blankImage, false);
                imagesavealpha($blankImage, true);
                self::addTransparency($blankImage, $image);
                imagecopyresampled($blankImage,$image,0,0,$size->x,$size->y,$size->width,$size->height,$size->w,$size->h);
                imagepng($blankImage, $imageNewPath);
                break;
        }

        $imageNewPath = str_replace(ABS_PATH, '/', $imageNewPath);

        return $imageNewPath;
    }

    /**
     * Добавляет прозрачность
     * @param $dst mixed Изображение назначения
     * @param $src mixed Изображение исходника
     */
    private static function addTransparency($dst, $src) {

        $index = imagecolortransparent($src);
        $color = array(
            'red' => 255,
            'green' => 255,
            'blue' => 255
        );
        if ($index >= 0) {
            $color = imagecolorsforindex($src, $index);
        }
        $index = imagecolorallocate(
            $dst,
            $color['red'],
            $color['green'],
            $color['blue']
        );
        imagefill($dst, 0, 0, $index);
        imagecolortransparent($dst, $index);
    }

    /**
     * Загрузка изображения
     * @param $image mixed Объект изображения
     * @param $sessionId int ID фотосессии
     * @return bool|string
     */
    public static function upload($image, $sessionId) {

        //Определение путей
        $dirPath = ABS_PATH.'uploads/gallery/';
        $sessionDirPath = $dirPath.(string) $sessionId.'/';
        $sizeDirPath = $sessionDirPath.'original/';

        //Создаем папку, если нужно
        if (!file_exists($sizeDirPath)) {
            $result = @mkdir($sizeDirPath, 0777, true);
            if (!$result) return false;
        }

        //Определяем с именем файла
        $imageName = $image['name'];
        $imageExt = substr($imageName, strrpos($imageName, '.'));
        $imageTitle = substr($imageName, 0, strrpos($imageName, '.'));
        $imageNewTitle = (string) $sessionId.'_original_'.Translate::convert(Translate::translit($imageTitle));
        $imageNewPath = $sizeDirPath.$imageNewTitle.$imageExt;

        //Если файл уже существует
        if (file_exists($imageNewPath)) {
            $imageNewPath = $sizeDirPath.$imageNewTitle.time().$imageExt;
        }

        $result = move_uploaded_file($image['tmp_name'], $imageNewPath);

        $imageNewPath = str_replace(ABS_PATH, '/', $imageNewPath);

        if ($result) return $imageNewPath;
        else return $result;
    }
}