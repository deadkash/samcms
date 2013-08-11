<?php

/**
 * Список материалов
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 12.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsViewList extends View {

    /** @var string Шаблон по умолчанию */
    private $defaultTemplate = 'list.twig';

    /** @var int На странице */
    private $onPage = 10;

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

        $parameters = Parameters::getComponentParameters($this->component, $this->itemId);

        //Выбор шаблона
        $template = (isset($parameters['template_list']))
            ? $parameters['template_list'] : $this->defaultTemplate;
        $this->setTemplate($template);

        //Количество на странице и страница
        $this->onPage = (isset($parameters['count'])) ? $parameters['count'] : $this->onPage;
        $page = Request::getInt('page');
        if ($page) $page--;

        //Загрузка материалов
        $categoryId = (isset($parameters['category_id'])) ? $parameters['category_id'] : false;
        $category = $this->model->getCategoryById($categoryId);
        $this->setValue('category', $category);

        $materials = $this->model->getMaterials($categoryId, $page, $this->onPage);
        $count = $this->model->getMaterialsCount();

        foreach ($materials as &$material) {
            $material->href = $this->router->getUrl(array(
                'id' => $this->itemId,
                'material_id' => $material->id
            ));
            $material->date = DatetimeHelper::prepareDate($material->date);
        }
        $this->setValue('materials', $materials);

        //Постраничная навигация
        $this->setValue('pageline', $this->model->getPageLine($page, $count, $this->onPage));

        $this->setLastModifiedDate();
        $this->setSEOParams();

        //Добавление ссылки на RSS
        $feedUrl = $this->router->getUrl(array('id' => $this->itemId, 'view' => 'rss'));
        $document = Document::get();
        $document->addFeed($feedUrl, $category->title);

        return $this->render();
    }

    /**
     * Устанавливает дату модификации
     * @return void
     */
    private function setLastModifiedDate() {

        $params = Parameters::getItemParameters($this->itemId);
        if (isset($params->modified)) {
            $document = Document::get();
            $lastModifiedDate = strtotime($params->modified);
            $document->setLastModifiedDate(gmdate('D, d M Y H:i:s', $lastModifiedDate).' GMT');
        }
    }

    /**
     * Устанавливает сео-параметры
     * @return void
     */
    private function setSEOParams() {

        $document = Document::get();

        $parameters = Parameters::getSectionParameters($this->itemId);
        if (isset($parameters['title']) && !empty($parameters['title'])) {
            $document->setTitle($parameters['title']);
        }
        if (isset($parameters['description'])) {
            $document->setDescription($parameters['description']);
        }
        if (isset($parameters['keywords'])) {
            $document->setKeywords($parameters['keywords']);
        }
    }
}