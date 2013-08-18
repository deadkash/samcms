<?php
/**
 * Модель результатов поиска
 *
 * @project SamCMS
 * @package Search
 * @author Kash
 * @date 13.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class SearchModelMain extends Model {

    /** @var int Длина индекса для вывода */
    private $indexLength = 300;

    /**
     * Конструктор
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Возвращает результаты
     * @param $keyword
     * @param $page
     * @param $onPage
     * @return array|bool
     */
    public function getResults($keyword, $page, $onPage) {

        $keyword = $this->db->escape($keyword);
        $page = (int) $page;
        $onPage = (int) $onPage;

        $query = "SELECT SQL_CALC_FOUND_ROWS
                         `id`,
                         `title`,
                         `index`,
                         `href`,
                         `element_id`,
                         `type`,
                         `modified`,
                         MATCH (`index`,`title`) AGAINST ('$keyword') AS `relevancy`
                    FROM `search`
                   WHERE MATCH (`index`,`title`) AGAINST ('$keyword')
                   LIMIT ".($page * $onPage).",". $onPage.";";
        $this->db->setQuery($query);

        $router = Router::create();
        $results = $this->db->getObjectList();
        $count = $this->getResultsCount();

        foreach ($results as &$result) {
            $result->href = $router->rewriteUrl('?'.$result->href);
            $result->index = strip_tags($result->index);
            if (mb_strlen($result->index, 'utf-8') > $this->indexLength) {
                $result->index = mb_substr($result->index, 0, $this->indexLength, 'utf-8');
            }
        }

        return array('results' => $results, 'count' => $count);
    }

    /**
     * Возвращает общее количество результатов
     * @return bool
     */
    public function getResultsCount() {

        $query = "SELECT FOUND_ROWS() AS `count`;";
        $this->db->setQuery($query);
        $count = $this->db->getObject();

        if (isset($count->count)) return $count->count;
        else return false;
    }
}
