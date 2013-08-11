<?php

/**
 * Класс роутера карты сайта
 *
 * @project SamCMS
 * @package Sitemap
 * @author Kash
 * @date 10.07.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class SitemapRoute extends Route {

    /**
     * Заменяет параметры псевдонимами.
     *
     * @param $params
     * @return string
     */
    public static function rewriteParams($params) {

        $output = '';
        $undefined = array();
        foreach ($params as $name => $value) {

            switch ($name) {

                case 'view':
                    $output .= $value.'/';
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
            $_GET['view'] = $params[0];
            unset($params[0]);
        }

        if (count($params))
            Router::redirect(Router::create()->getUrl(array('id'=>Parameters::getParameter('404_section'))));
    }
}