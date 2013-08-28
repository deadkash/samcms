<?php
/**
 * Класс документа
 *
 * @project SamCMS
 * @package Core
 * @author Kash
 * @date 30.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class Document {

    /**
     * HTTP статус документа
     * @var string
     */
    private $HTTPstatus = 'HTTP/1.0 200 Ok';

    /**
     * URL перенаправления
     * @var string
     */
    private $location;

    /**
     * Тип контента
     * @var string
     */
    private $contentType = 'text/html';

    /**
     * Кодировка документа
     * @var string
     */
    private $encoding = 'utf-8';

    /**
     * Заголовок документа
     * @var string
     */
    private $title;

    /**
     * Описание документа
     * @var string
     */
    private $description;

    /**
     * Ключевые слова документа
     * @var string
     */
    private $keywords;

    /**
     * Данные для шаблона
     * @var array
     */
    private $data;

    /**
     * Шаблон документа
     * @var string
     */
    private $template;

    /**
     * Путь к шаблонам
     * @var string
     */
    private $tplPath;

    /**
     * Массив css файлов
     * @var array
     */
    private $css = array();

    /**
     * Массив js файлов
     * @var array
     */
    private $js = array();

    /**
     * Дата последней модификации
     * @var string
     */
    private $lastModifiedDate;

    /**
     * RSS лента
     * @var array
     */
    private $feed;

    /**
     * Экземпляр класса
     * @var Document
     */
    private static $document;

    /**
     * Создание экземпляра класса
     * @return Document
     */
    public static function get() {

        if (!self::$document instanceof self) {
            self::$document = new self();
        }

        return self::$document;
    }

    /**
     * Клонирование
     */
    private function __clone() {}

    /**
     * Конструктор
     */
    private function __construct() {

        $this->lastModifiedDate = gmdate('D, d M Y H:i:s').' GMT';
    }

    /**
     * Отрисовка документа
     * @return void
     */
    public function render() {

        //Отправляем заголовки
        header($this->HTTPstatus);
        if (!empty($this->location)) {
            header('Location: '.$this->location);
            exit;
        }
        header('Content-Type: '.$this->contentType.'; charset='.$this->encoding);
        header('Last-Modified: '.$this->lastModifiedDate);

        //Мета-данные
        $this->data['documentTitle'] = $this->title;
        $this->data['documentDescription'] = $this->description;
        $this->data['documentKeywords'] = $this->keywords;

        //Декларация css и js
        $this->data['css'] = $this->css;
        $this->data['js'] = $this->js;

        //Декларация ленты новостей
        if (!empty($this->feed)) $this->data['feed'] = $this->feed;

        echo Templater::render($this->tplPath, $this->template, $this->data);
    }

    /**
     * Установка http-статуса
     * @param $HTTPstatus
     */
    public function setHTTPStatus($HTTPstatus) {
        $this->HTTPstatus = $HTTPstatus;
    }

    /**
     * Возвращает http-статус
     * @return string
     */
    public function getHTTPStatus() {
        return $this->HTTPstatus;
    }

    /**
     * Установка редиректа
     * @param $location
     */
    public function setLocation($location){
        $this->location = $location;
    }

    /**
     * Возвращает редиректа URL
     * @return string
     */
    public function getLocation() {
        return $this->location;
    }

    /**
     * Установка типа документа
     * @param $contentType
     */
    public function setContentType($contentType) {
        $this->contentType = $contentType;
    }

    /**
     * Возвращает тип документа
     * @return string
     */
    public function getContentType() {
        return $this->contentType;
    }

    /**
     * Установка кодировки документа
     * @param $encoding
     */
    public function setEncoding($encoding) {
        $this->encoding = $encoding;
    }

    /**
     * Возвращает кодировку документа
     * @return string
     */
    public function getEncoding() {
        return $this->encoding;
    }

    /**
     * Устанавливает дату последней модикации
     * @param $lastModifiedDate
     */
    public function setLastModifiedDate($lastModifiedDate) {
        $this->lastModifiedDate = $lastModifiedDate;
    }

    /**
     * Возвращает дату последней модицикации
     * @return string
     */
    public function getLastModifiedDate() {
        return $this->lastModifiedDate;
    }

    /**
     * Установка пути к шаблонам
     * @param $tplPath
     */
    public function setTplPath($tplPath) {
        $this->tplPath = $tplPath;
    }

    /**
     * Возвращает путь к шаблонам
     * @return string
     */
    public function getTplPath() {
        return $this->tplPath;
    }

    /**
     * Устанавливает шаблон
     * @param $template
     */
    public function setTemplate($template) {
        $this->template = $template;
    }

    /**
     * Возвращает шаблон
     * @return string
     */
    public function getTemplate() {
        return $this->template;
    }

    /**
     * Устанавливает значение переменной
     * @param $name
     * @param $value
     */
    public function setValue($name, $value) {
        $this->data[$name] = $value;
    }

    /**
     * Возвращает значение переменной
     * @param $name
     * @return bool
     */
    public function getValue($name) {
        if (isset($this->data[$name])) return $this->data[$name];
        else return false;
    }

    /**
     * Установка заголовка документа
     * @param $title
     */
    public function setTitle($title) {
        $this->title = Language::translate($title);
    }

    /**
     * Возвращает заголовок документа
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Установка описания документа
     * @param $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Возвращает описание документа
     * @return string
     */
    public function getDescription(){
        return $this->description;
    }

    /**
     * Устанавливает ключевые слова документа
     * @param $keywords
     */
    public function setKeywords($keywords){
        $this->keywords = $keywords;
    }

    /**
     * Возвращает ключевые слова документа
     * @return string
     */
    public function getKeywords(){
        return $this->keywords;
    }

    /**
     * Добавляет css файл
     * @param $css
     */
    public function addCSS($css){
        if (!in_array($css, $this->css)) $this->css[] = $css;
    }

    /**
     * Возвращает css файлы
     * @return array
     */
    public function getCSS() {
        return $this->css;
    }

    /**
     * Добавляет js файл
     * @param $js
     */
    public function addJS($js){
        if (!in_array($js, $this->js)) $this->js[] = $js;
    }

    /**
     * Возвращает js файлы
     * @return array
     */
    public function getJS() {
        return $this->js;
    }

    /**
     * Декларация ленты новостей
     * @param $url
     * @param $title
     */
    public function addFeed($url, $title) {
        $this->feed['url'] = $url;
        $this->feed['title'] = $title;
    }
}