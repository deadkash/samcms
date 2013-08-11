<?php

/**
 * Роутер поиска
 *
 * @project SamCMS
 * @package Search
 * @author Kash
 * @date 10.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class SearchRoute extends Route {

    /**
     * Заменяет параметры псевдонимами.
     * @param $params
     * @return string
     */
    public static function rewriteParams($params) {

        $output = '';
        $undefined = array();
        foreach ($params as $name => $value) {

            switch ($name) {

                case 'page':
                    $output .= 'page/'.$value.'/';
                    break;

                default:
                    $undefined[$name] = $value;
                    break;
            }
        }

        $end = Parameters::getParameter('end');
        $output = substr($output, 0, strlen($output)-1);
        $output.= $end;

        $newQuery = '?';
        foreach ($undefined as $name => $value) {
            $newQuery .= $name.'='.$value.'&';
        }
        $newQuery = substr($newQuery, 0, strlen($newQuery) - 1);

        return $output.$newQuery;
    }

    /**
     * Восстанавливает параметры из URL
     * @param $params
     */
    public static function recoverParams($params) {

        if (isset($params[0])) {

            if ($params[0] == 'page') {
                if (isset($params[1])) {
                    $_GET['page'] = $params[1];
                    unset($params[0]);
                    unset($params[1]);
                }
            }
        }

        if (count($params)) {
            Router::redirect(Router::create()->getUrl(array('id'=>Parameters::getParameter('404_section'))));
        }
    }
}