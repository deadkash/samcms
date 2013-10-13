<?php

/**
 * RSS лента материалов
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 12.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsViewRss extends View {

    /**
     * Конструктор
     * @param $name
     */
    public function __construct($name){
        parent::__construct($name);
    }

    /**
     * Отрисовка
     * @return void
     */
    public function display(){

        $this->setModel('Main');

        $document = Document::get();
        $document->setTplPath(APP_PATH.'components/materials/views/rss/templates/');
        $document->setTemplate('rss.twig');
        $document->setContentType('application/xml');

        $parameters = Parameters::getComponentParameters($this->component, $this->itemId);

        $categoryId = (isset($parameters['category_id'])) ? $parameters['category_id'] : false;
        $category = $this->model->getCategoryById($categoryId);
        $document->setValue('category', $category);

        //Загрузка материалов
        $materials = $this->model->getRSSMaterials($categoryId);
        foreach ($materials as &$material) {
            $material->url = $this->router->getUrl(array(
                'id' => $this->itemId,
                'material_id' => $material->id
            ));
            $material->date = date('r',strtotime($material->date));
            $material->preview = htmlentities($material->preview);
        }
        $document->setValue('materials', $materials);

        $feedUrl = $this->router->getUrl(array('id' => $this->itemId, 'view' => 'rss'));
        $document->setValue('feedUrl', $feedUrl);

        $url = $this->router->getUrl(array('id' => $this->itemId));
        $document->setValue('url', $url);

        $document->render();
        exit;
    }
}