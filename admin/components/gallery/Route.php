<?php
/**
 * Роутер галереи
 *
 * @project SamCMS
 * @package Gallery
 * @author Kash
 * @date 09.06.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class GalleryRoute extends Route {

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
                    $output .= $value.'/';
                    break;

                case 'view':
                    $output .= $value.'/';
                    break;

                case 'session_id':
                    $output .= $value.'/';
                    break;

                case 'size_id':
                    $output .= 'size/'.$value.'/';
                    break;

                case 'image_id':
                    $output .= 'image/'.$value.'/';
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
            $_GET['session_id'] = (int) $params[2];
            unset($params[2]);
        }

        if (isset($params[3])) {

            switch ($params[3]) {

                case 'size':
                    $_GET['size_id'] = (int) $params[4];
                    unset($params[3]);
                    unset($params[4]);
                    break;

                case 'image':
                    $_GET['image_id'] = (int) $params[4];
                    unset($params[3]);
                    unset($params[4]);
                    break;
            }
        }

        if (count($params))
            Router::redirect(Router::create()->getUrl(array('id'=>Parameters::getParameter('404_section_admin'))));
    }
}