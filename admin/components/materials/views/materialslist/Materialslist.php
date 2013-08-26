<?php

/**
 * Представление списка материалов
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 26.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsViewMaterialslist extends View {

    /** @var int Количество на странице */
    private $onPage = 10;

    /**
     * Конструктор
     */
    public function __construct($name) {
        parent::__construct($name);
    }

    /**
     * Отрисовка
     * @return string
     */
    public function display() {

        //Загружаем модель
        $this->setModel('Material');

        //Текущая категория
        $categoryId = Request::getInt('category');

        //Страница
        $page = Request::getInt('page');
        if ($page) $page--;

        //Материалы
        $materials = $this->model->getMaterials($categoryId, $page, $this->onPage);
        $count = $this->model->getMaterialsCount();
        foreach ($materials as &$material) {
            $material->date = DatetimeHelper::prepareDate($material->date);
            $material->edit = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'Materials',
                'view' => 'Edit',
                'material_id' => $material->id
            ));
        }
        $this->setValue('materials', $materials);

        //Категории
        $categories = $this->getModel('Category')->getCategories();
        if ($categories && count($categories) > 1) {
            foreach ($categories as &$category) {
                $category->current = ($category->id == $categoryId);
            }
            $this->setValue('categoryList', $categories);
        }

        //Страницы
        $params = array('controller' => 'Materials', 'view' => 'Materialslist', 'category'=>$categoryId);
        $pages = $this->model->getPageLine($page, $count, $this->onPage, $params);
        if ($pages) {
            $this->setValue('pages', $pages);
        }

        //Кнопка добавить
        $addLink = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'Materials','view'=>'Add'));
        $this->setValue('add', $addLink);

        //Ссылка на список категорий
        $catLink = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'Categories','view'=>'Categorylist'));
        $this->setValue('categories', $catLink);

        //Устанавливаем шаблон
        $this->setTemplate('materialslist.twig');

        return $this->render();
    }
}