<?php

/**
 * Класс для транслитерации
 *
 * @project SamCMS
 * @package Core
 * @author Kash
 * @date 23.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Translate extends Core {

    /**
     * Производит транслитерацию строки
     * @param $string
     * @return string
     */
    public static function translit($string) {

        if (empty($string)) return $string;

        $from = array(
            'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х',
            'ц','ч','ш','щ','ь','ы','ъ','э','ю','я','А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К',
            'Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ь','Ы','Ъ','Э','Ю','Я'
        );

        $to = array(
            'a','b','v','g','d','e','e','zh','z','i','j','k','l','m','n','o','p','r','s','t','u','f',
            'h','c','ch','sh','sch','-','y','-','e','ju','ya','A','B','V','G','D','E','E','Zh','Z','I',
            'J','K','L','M','N','O','P','R','S','T','U','F','H','C','Ch','Sh','Sch','-','Y','-','E','Ju','Ya'
        );

        return str_replace($from, $to, $string);
    }

    /**
     * Конвертация псевдонима
     * @param $string
     * @return string
     */
    public static function convert($string) {

        $string = mb_strtolower(trim($string), 'utf-8');
        $string = preg_replace('/(\s)+|[^-_a-z0-9]+/Uis', '-', $string);
        $string = trim(preg_replace('/[-]{2,}/s', '-', $string), '-');

        return substr($string, 0, 100);
    }
}