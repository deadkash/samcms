<?php

/**
 * Класс языковых функций
 *
 * @project SamCMS
 * @package core
 * @author Kash
 * @date 04.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Language extends Core {

    /**
     * Словарь
     * @var array
     */
    private static $dictionary = array();

    /**
     * Использовать кэш
     * @var bool
     */
    private static $cache = false;

    /**
     * Использовать php словари
     * @var bool
     */
    private static $php = true;

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает список языков
     * @return array|bool
     */
    public function getLanguages() {

        $query = "SELECT `id`,`title`,`name`,`prefix`
                    FROM `language`;";
        $this->db->setQuery($query);

        return $this->db->getObjectList();
    }

    /**
     * Возвращает язык по имени
     * @param $name
     * @return bool|stdClass
     */
    public static function getLanguageByName($name) {

        $db = DB::create();
        $name = $db->escape($name);
        $query = "SELECT `id`,`title`,`name`,`prefix`
                    FROM `language`
                   WHERE `name`='".$name."';";
        $db->setQuery($query);
        return $db->getObject();
    }

    /**
     * Устанавливает словари
     * @param $languageName
     */
    private static function setDictionary($languageName) {

        $language = self::getLanguageByName($languageName);
        $dictionaryList = self::getDictionaryList($language);

        foreach ($dictionaryList as $dictionaryPath) {
            if (self::$php) {
                self::scanPHPDictionary($dictionaryPath);
            }
            else {
                self::scanDictionary($dictionaryPath);
            }
        }

        if (self::$cache) {
            self::setCache(self::$dictionary, $languageName);
        }
    }

    /**
     * Устанавливает пользовательские словари
     * @param $path
     */
    public static function setCustomDictionary($path){

        $dictionaryList = self::getCustomDictionaryList($path);

        foreach ($dictionaryList as $dictionaryPath) {
            if (self::$php) {
                self::scanPHPDictionary($dictionaryPath);
            }
            else {
                self::scanDictionary($dictionaryPath);
            }
        }

        if (self::$cache) {
            self::setCache(self::$dictionary, 'custom');
        }
    }

    /**
     * Сканирует словарь
     * @param $dictionaryPath
     */
    private static function scanDictionary($dictionaryPath) {

        //Если существует словарь
        if (file_exists($dictionaryPath)) {

            $dictionary = @file_get_contents($dictionaryPath);
            $lines = explode("\n", $dictionary);
            foreach ($lines as $line) {
                $line = trim($line);

                if (!strpos($line, '=')) continue;
                list($name, $value) = explode('=', $line);
                $name = trim($name);
                $value = trim($value);
                if (!empty($name) && !empty($value)) {
                    self::$dictionary[$name] = $value;
                }
            }
        }
    }

    /**
     * Возвращает php словарь
     * @param $dictionaryPath
     */
    private static function scanPHPDictionary($dictionaryPath) {

        if (file_exists($dictionaryPath)) {

            $dictionary = include_once($dictionaryPath);

            if (is_array($dictionary)) {
                self::$dictionary = array_merge(self::$dictionary, $dictionary);
            }
        }
    }

    /**
     * Возвращает массив словарей
     * @param $language
     * @return array
     */
    private static function getDictionaryList($language) {

        $output = array();
        if (!isset($language->prefix)) return $output;
        $dictPath = APP_PATH.'languages/'.$language->prefix.'/';
        $langExt = '.ln';
        if (self::$php) $langExt = '.php';

        //Если не существует папка со словарями
        if (!file_exists($dictPath)) return $output;

        $files = scandir($dictPath);

        foreach ($files as $file) {

            if (strrpos($file, $langExt) === (strlen($file) - strlen($langExt))) {
                $output[] = $dictPath.$file;
            }
        }

        return $output;
    }

    /**
     * Возвращает список пользовательских словарей
     * @param $dictPath
     * @return array
     */
    private static function getCustomDictionaryList($dictPath){

        $output = array();
        $langExt = '.ln';
        if (self::$php) $langExt = '.php';

        //Если не существует папка со словарями
        if (!file_exists($dictPath)) return $output;

        $files = scandir($dictPath);

        foreach ($files as $file) {

            if (strrpos($file, $langExt) === (strlen($file) - strlen($langExt))) {
                $output[] = $dictPath.$file;
            }
        }

        return $output;
    }

    /**
     * Возвращает словарь
     * @param $language
     * @return array
     */
    public static function getDictionary($language) {

        //Выходим если язык пуст
        if (empty($language)) return false;

        //Если словарь пуст и можно брать из бд, то берем
        if (empty(self::$dictionary) && self::$cache) {
            self::getCache($language);
        }

        //Если словарь все равно пуст, то парсим языковые файлы
        if (empty(self::$dictionary)) {
            self::setDictionary($language);
        }

        return self::$dictionary;
    }

    /**
     * Перевод слова
     * @param $value
     * @return mixed
     */
    public static function translate($value) {

        //Если словарь пуст и можно брать из бд, то берем
        if (empty(self::$dictionary) && self::$cache) {
            self::getCache(Parameters::getParameter('language'));
        }

        //Если словарь все равно пуст, то парсим языковые файлы
        if (empty(self::$dictionary)) {
            self::setDictionary(Parameters::getParameter('language'));
        }

        if (isset(self::$dictionary[$value])) {
            return self::$dictionary[$value];
        }
        else return $value;
    }

    /**
     * Кэшируем в базу языковой словарь
     * @param $dictionary
     * @param $language
     */
    private static function setCache($dictionary, $language) {

        $db = DB::create();
        $db->delete('language_cache', 'language', $language);
        foreach ($dictionary as $name => $value) {
            $field = new stdClass();
            $field->name = $name;
            $field->value = $value;
            $field->language = $language;
            $db->insert('language_cache', $field);
        }
    }

    /**
     * Достаем языковой словарь из кэша
     * @param $language
     */
    private static function getCache($language) {

        $db = DB::create();
        $language = $db->escape($language);
        $query = "SELECT `name`,`value`
                    FROM `language_cache`
                   WHERE `language`='".$language."';";

        $db->setQuery($query);
        $fields = $db->getObjectList();

        foreach ($fields as $field) {
            self::$dictionary[$field->name] = $field->value;
        }
    }
}