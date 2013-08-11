<?php

/**
 * Роутер материалов
 *
 * @project SamCMS
 * @package Materials
 * @author Kash
 * @date 25.05.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class MaterialsRoute extends Route {

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

                case 'controller':
                    $output .= strtolower($value).'/';
                    break;

                case 'view':
                    $output .= strtolower($value).'/';
                    break;

                case 'category_id':
                    $output .= $value.'/';
                    break;

                case 'material_id':
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
            $_GET['controller'] = $params[0];
            unset($params[0]);
        }

        if (isset($params[1])) {
            $_GET['view'] = $params[1];
            unset($params[1]);
        }

        if (isset($params[2])) {
            switch ($_GET['controller']) {
                case 'categories':
                    $_GET['category_id'] = $params[2];
                    break;
                case 'materials':
                    switch ($_GET['view']) {

                        case 'Materialslist':
                            $_GET['category_id'] = $params[2];
                            break;

                        default:
                            $_GET['material_id'] = $params[2];
                            break;
                    }
                    break;
            }
            unset($params[2]);
        }

        if (isset($params[3])) {

            $_GET['page'] = str_replace('page', '', $params[3]);
            unset($params[3]);
        }

        if (count($params))
            Router::redirect(Router::create()->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));
    }
}