<?php

/**
 * Детальная материала
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 12.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsViewDetail extends View {

    /** @var string Шаблон по умолчанию */
    private $defaultTemplate = 'detail.twig';

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name){
        parent::__construct($name);
    }

    /**
     * Отрисовка
     * @return string
     */
    public function display() {

        $this->setModel('Main');

        //Загрузка материалов
        $materialId = Request::getInt('material_id');
        $material = $this->model->getMaterialById($materialId);

        if (!$material) {
            Router::redirect($this->router->getUrl(array('id'=>Parameters::getParameter('404_section'))));
        }

        $lastModifiedDate = strtotime($material->date);
        $material->date = DatetimeHelper::prepareDate($material->date);
        $this->setValue('material', $material);

        //Выбор шаблона
        $parameters = Parameters::getComponentParameters($this->component, $this->itemId);
        $template = (isset($parameters['template_detail']))
            ? $parameters['template_detail'] : $this->defaultTemplate;
        $this->setTemplate($template);

        $document = Document::get();
        $document->setLastModifiedDate(gmdate('D, d M Y H:i:s', $lastModifiedDate).' GMT');

        $this->setSEOParams();

        return $this->render();
    }

    /**
     * Устанавливает сео-параметры
     * @return void
     */
    private function setSEOParams() {

        $document = Document::get();
        if (isset($this->data['material'])) {

            $document->setTitle($this->data['material']->meta_title);
            $document->setDescription($this->data['material']->meta_description);
            $document->setKeywords($this->data['material']->meta_keywords);
        }
    }
}