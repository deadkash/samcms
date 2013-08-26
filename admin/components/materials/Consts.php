<?php

/**
 * Константы
 *
 * @package Materials
 * @project SamCMS
 * @author Kash
 * @date 25.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsConsts {

    /**
     * Возвращает поля категории
     * @return array
     */
    public static function getCategoryFields(){

        $fields = array();

        //Название категории
        $title = new Field();
        $title->setName('title')
              ->setTitle('materials_title')
              ->setType('text')
              ->setClass('input-xlarge')
              ->setDefault('')
              ->setRequired(true);
        $fields[] = $title;

        //Описание категории
        $description = new Field();
        $description->setName('description')
                    ->setTitle('materials_description')
                    ->setType('editor')
                    ->setDefault('')
                    ->setHeight(300);
        $fields[] = $description;

        return $fields;
    }

    /**
     * Возвращает поля материала
     * @return array
     */
    public static function getMaterialFields(){

        $fields = array();

        //Название материала
        $title = new Field();
        $title->setName('title')
              ->setTitle('materials_title')
              ->setType('text')
              ->setClass('span4')
              ->setDefault('')
              ->setRequired(true);
        $fields[] = $title;

        //Категория
        $categoryId = new Field();
        $categoryId->setName('category_id')
                   ->setTitle('materials_cat')
                   ->setType('category')
                   ->setDefault('')
                   ->setRequired(true);
        $fields[] = $categoryId;

        //Дата публикации
        $date = new Field();
        $date->setName('date')
             ->setTitle('materials_pub_date')
             ->setType('datetime')
             ->setDefault('')
             ->setRequired(true);
        $fields[] = $date;

        //Краткий текст
        $preview = new Field();
        $preview->setName('preview')
                ->setTitle('materials_preview')
                ->setType('editor')
                ->setDefault('')
                ->setRequired(true)
                ->setHeight(300);
        $fields[] = $preview;

        //Полный текст
        $fulltext = new Field();
        $fulltext->setName('fulltext')
                 ->setTitle('materials_fulltext')
                 ->setType('editor')
                 ->setDefault('');
        $fields[] = $fulltext;

        //Заголовок страницы
        $metaTitle = new Field();
        $metaTitle->setName('meta_title')
                  ->setTitle('materials_meta_title')
                  ->setType('text')
                  ->setDefault('')
                  ->setClass('span4');
        $fields[] = $metaTitle;

        //Описание страницы
        $metaDescription = new Field();
        $metaDescription->setName('meta_description')
                        ->setTitle('materials_meta_description')
                        ->setType('textarea')
                        ->setClass('span4')
                        ->setDefault('');
        $fields[] = $metaDescription;

        //Ключевые слова страницы
        $metaKeywords = new Field();
        $metaKeywords->setName('meta_keywords')
                     ->setTitle('materials_meta_keywords')
                     ->setType('textarea')
                     ->setClass('span4')
                     ->setDefault('');
        $fields[] = $metaKeywords;

        //Частота обновления
        $seoFrequency = new Field();
        $seoFrequency->setName('seo_frequency')
                     ->setTitle('materials_frequency')
                     ->setType('frequency')
                     ->setDefault('always');
        $fields[] = $seoFrequency;

        //Приоритет
        $seoPriority = new Field();
        $seoPriority->setName('seo_priority')
                    ->setTitle('materials_priority')
                    ->setType('priority')
                    ->setDefault('1.0');
        $fields[] = $seoPriority;

        return $fields;
    }
}