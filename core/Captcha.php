<?php
/**
 * Генератор каптчи
 *
 * @project SamCMS
 * @package core
 * @author Kash
 * @date 08.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Captcha extends Core {

    /**
     * Символы
     * @var string
     */
    private $chars = 'abcdefknstyz23456789';

    /**
     * Минимальная длина
     * @var int
     */
    private $min = 4;

    /**
     * Максимальная длина
     * @var int
     */
    private $max = 7;

    /**
     * Высота
     * @var int
     */
    private $width = 130;

    /**
     * Ширина
     * @var int
     */
    private $height = 40;

    /**
     * Цвет фона
     * @var string
     */
    private $bgColor = '#ffffff';

    /**
     * Цвет рамки
     * @var string
     */
    private $borderColor = '#000000';

    /**
     * Цвет текста
     * @var string
     */
    private $textColor = '#000000';

    /**
     * Размер шрифта
     * @var int
     */
    private $fontSize = 20;

    /**
     * Шрифт
     * @var string
     */
    private $fontFile = './../lib/fonts/font.ttf';

    /**
     * Размытие
     * @var bool
     */
    private $distortion = true;

    /**
     * Текст капчи
     * @var string
     */
    private $text = '';

    /**
     * Рамка
     * @var bool
     */
    private $border = true;

    /**
     * Посылает заголовки
     * @return void
     */
    private function setHeaders() {

        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", 10000) . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-Type:image/png");
    }

    /**
     * Переводит rgb в hex
     * @param string $color
     * @return mixed
     */
    private function rgb2hex($color){

        $output = array('r'=>0xFF,'g'=>0xFF,'b'=>0xFF);
        if(empty($color)) return $output;

        $output['r'] = hexdec('0x'.substr($color, 1, 2));
        $output['g'] = hexdec('0x'.substr($color, 3, 2));
        $output['b'] = hexdec('0x'.substr($color, 5, 2));

        return $output;
    }

    /**
     * Добавляет размытие
     * @param $image
     */
    private function setBlur($image){

        $width = imagesx($image);
        $height = imagesy($image);
        $distance = 1;

        $tempImage = imagecreatetruecolor($width, $height);
        imageCopy($tempImage, $image, 0, 0, 0, 0, $width, $height);

        //Уровень размытия
        $blurLevel = 27;

        imagecopymerge($tempImage, $image, 0, 0, 0, $distance, $width-$distance, $height-$distance, $blurLevel);
        imagecopymerge($image, $tempImage, 0, 0, $distance, 0, $width-$distance, $height, $blurLevel);
        imagecopymerge($tempImage, $image, 0, $distance, 0, 0, $width, $height, $blurLevel);
        imagecopymerge($image, $tempImage, $distance, 0, 0, 0, $width, $height, $blurLevel);

        imagedestroy($tempImage);
    }

    /**
     * Добавляет искажения
     * @param $image
     * @param $imageBg
     * @return mixed
     */
    private function setDistortion($image, $imageBg) {

        $q = mt_rand(-7, 7);
        for ($x = 0; $x <= $this->width-1; $x++){
            for($y = 0; $y <= $this->height-1; $y++){

                $ny = sin(deg2rad(300 / $this->width * $x) - $q);
                imagecopy($imageBg, $image, $x, 0 + ($ny * ($this->height / 4)), $x, 0, 1, $this->height);
            }
        }
        $this->setBlur($imageBg);

        return $imageBg;
    }

    /**
     * Рисует рамку
     * @param $image
     */
    private function setBorder(&$image) {

        $borderColor = $this->rgb2hex($this->borderColor);
        $borderColor = imagecolorallocate($image, $borderColor['r'], $borderColor['g'], $borderColor['b']);

        imageline($image, 0, 0, 0, $this->height, $borderColor);
        imageline($image, $this->width-1, 0, $this->width-1, $this->height, $borderColor);
        imageline($image, 0, 0, $this->width, 0, $borderColor);
        imageline($image, 0, $this->height-1, $this->width, $this->height-1, $borderColor);
    }

    /**
     * Генерация изображения
     * @return void
     */
    public function generate() {

        //Отсылаем заголовки
        $this->setHeaders();

        //Создаем изображения
        $image  = imagecreate($this->width, $this->height);
        $tempImage = imagecreate($this->width, $this->height);
        $bgColor   = $this->rgb2hex($this->bgColor);

        imagecolorallocate($image, $bgColor['r'], $bgColor['g'], $bgColor['b']);
        imagecolorallocate($tempImage, $bgColor['r'], $bgColor['g'], $bgColor['b']);

        //Генерация текста
        $symbolsCount = rand($this->min, $this->max);
        for ($i = 0; $i < $symbolsCount; $i++){

            //Цвет текста
            $textColor = $this->rgb2hex($this->textColor);
            $textColor = imagecolorallocate($image, $textColor['r'], $textColor['g'], $textColor['b']);

            //Случайный символ
            $randSymbol = $this->chars[mt_rand(0, strlen($this->chars)-1)];

            $angle = mt_rand(-35, 35);
            $x = 8 + ($i * $this->fontSize) + mt_rand(3, 6);
            $y = ($this->height / 2) + ($this->fontSize / 2) - 2;
            imagettftext($image, $this->fontSize, $angle, $x, $y, $textColor, $this->fontFile, $randSymbol);
            $this->text .= $randSymbol;
        }

        //Добавляем искажения
        if ($this->distortion) {
            $image = $this->setDistortion($image, $tempImage);
        }

        //Добавляем рамку
        if ($this->border) {
            $this->setBorder($image);
        }

        //Запоминаем текст
        $this->setText($this->text);

        imagepng($image);
    }

    /**
     * Запоминаем текст
     * @param $text
     */
    private function setText($text) {
        $_SESSION['captcha']= $text;
    }

    /**
     * Установка шрифта
     * @param $fontPath
     */
    public function setFont($fontPath) {
        $this->fontFile = $fontPath;
    }

    /**
     * Проверка кода
     * @param $text
     * @return bool
     */
    public static function check($text) {

        if (isset($_SESSION['captcha'])) {
            if ($_SESSION['captcha'] == $text) return true;
        }

        return false;
    }
}