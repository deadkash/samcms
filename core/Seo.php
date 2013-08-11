<?php

/**
 * Управление сео
 *
 * @project SamCMS
 * @package Core
 * @author Kash
 * @date 26.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class Seo {

    /**
     * Разделитель
     * @var string
     */
    private $delimiter = ' - ';

    /**
     * Экземпляр класса
     * @var Seo
     */
    public static $seo;

    /**
     * Создание экземпляра класса
     * @return Seo
     */
    public static function create() {

        if (!self::$seo instanceof self) {
            self::$seo = new self();
        }

        return self::$seo;
    }

    /**
     * Клонирование
     */
    private function __clone() {}

    /**
     * Конструктор
     */
    private function __construct() {
    }

    /**
     * Генерирует заголовок
     * @param $title
     * @return string
     */
    public function createTitle($title) {
        return $title.$this->delimiter.Parameters::getParameter('meta_title');
    }

    /**
     * Генерирует описание
     * @param $title
     * @return string
     */
    public function createDescription($title) {
        return $title.' '.Parameters::getParameter('meta_description');
    }

    /**
     * Генерирует ключевые слова
     * @param $title
     * @return string
     */
    public function createKeywords($title) {
        return Parameters::getParameter('meta_keywords').' '.$title;
    }
}