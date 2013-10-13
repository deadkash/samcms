<?php

/**
 * Представление списка категорий материалов
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 25.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsViewCategorylist extends View {

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
        $this->setModel('Category');

        //Список категорий
        $categories = $this->model->getCategories();
        foreach ($categories as &$category) {
            $category->edit = $this->router->getUrl(array(
                'id' => $this->itemId,
                'controller' => 'Categories',
                'view' => 'Edit',
                'category_id' => $category->id
            ));
        }
        $this->setValue('categories', $categories);

        //Ссылка на добавление
        $addLink = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'Categories','view'=>'Add'));
        $this->setValue('add', $addLink);

        //Адрес отправки формы
        $postUrl = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'Categories','view'=>'Categorylist'));
        $this->setValue('url', $postUrl);

        //Ссылка на материалы
        $materialsLink = $this->router->getUrl(array('id'=>$this->itemId,'controller'=>'Materials','view'=>'Materialslist'));
        $this->setValue('materials', $materialsLink);

        //Устанавливаем шаблон
        $this->setTemplate('categorylist.twig');

        return $this->render();
    }
}