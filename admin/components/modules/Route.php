<?php

/**
 * Класс роутера модулей
 *
 * @project SamCMS
 * @package Modules
 * @author Kash
 * @date 25.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class ModulesRoute extends Route {

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

                case 'type':
                    $output .= $value.'/';
                    break;

                case 'module_id':
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
            if ((int) $params[0]) {
                $_GET['module_id'] = $params[0];
            }
            else {
                $_GET['view'] = $params[0];
            }
            unset($params[0]);
        }

        if (isset($params[1])) {
            if (isset($_GET['module_id']) && (int) $_GET['module_id']) {
                $_GET['view'] = $params[1];
            }
            else $_GET['type'] = $params[1];
            unset($params[1]);
        }

        if (count($params))
            Router::redirect(Router::create()->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));
    }
}