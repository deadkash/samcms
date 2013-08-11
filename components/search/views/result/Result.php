<?php
/**
 * Представление результатов поиска
 *
 * @project SamCMS
 * @package Search
 * @author Kash
 * @date 13.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class SearchViewResult extends View {

    /** @var int Количество на странице */
    private $onPage = 20;

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
    public function display(){

        $this->setTemplate('result.twig');
        $this->setModel('Main');

        $keyword = Request::getStr('keyword');
        if ($keyword) {

            //Страница
            $page = Request::getInt('page');
            if ($page) $page--;

            $results = $this->model->getResults($keyword, $page, $this->onPage);
            foreach ($results['results'] as &$result) {
                $result->index = $this->findKeyword($keyword, $result->index);
            }
            $this->setValue('results', $results['results']);
            $this->setValue('count', $results['count']);

            //Постраничная навигация
            $this->setValue('pageline', $this->model->getPageLine($page, $results['count'],
                $this->onPage, array('keyword'=>$keyword)));
        }

        return $this->render();
    }

    /**
     * Находит в тексте поисковую фразу
     * @param $keyword
     * @param $index
     * @return mixed
     */
    private function findKeyword($keyword, $index) {

        $keywords = str_replace(' ', '|', $keyword);
        return preg_replace("/($keywords)/si","<strong>\\1</strong>",$index);
    }
}