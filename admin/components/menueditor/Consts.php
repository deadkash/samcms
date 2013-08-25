<?php

/**
 * Строковые данные модуля
 *
 * @project SamCMS
 * @package MenuEditor
 * @author Kash
 * @date 22.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MenueditorConsts {

    /**
     * Возвращает параметры раздела
     * @return array
     */
    public static function getSectionParams(){

        $fields = array();

        $title = new Field();
        $title->setName('title')
              ->setTitle('menueditor_pagetitle')
              ->setType('text')
              ->setClass('span4');
        $fields[] = $title;

        $description = new Field();
        $description->setName('description')
                    ->setTitle('menueditor_pagedescription')
                    ->setType('textarea')
                    ->setClass('span4');
        $fields[] = $description;

        $keywords = new Field();
        $keywords->setName('keywords')
                 ->setTitle('menueditor_pagekeywords')
                 ->setType('textarea')
                 ->setClass('span4');
        $fields[] = $keywords;

        $seoFrequency = new Field();
        $seoFrequency->setName('seo_frequency')
                     ->setTitle('core_frequency')
                     ->setType('frequency')
                     ->setDefault('always');
        $fields[] = $seoFrequency;

        $seoPriority = new Field();
        $seoPriority->setName('seo_priority')
                    ->setTitle('core_priority')
                    ->setType('priority')
                    ->setDefault('1.0');
        $fields[] = $seoPriority;

        $template = new Field();
        $template->setName('template')
                 ->setTitle('menueditor_pagetemplate')
                 ->setType('text')
                 ->setDefault('index.twig');
        $fields[] = $template;

        $titleH1 = new Field();
        $titleH1->setName('titleh1')
                ->setTitle('menueditor_titleh1')
                ->setType('text')
                ->setClass('span4');
        $fields[] = $titleH1;

        return $fields;
    }
}