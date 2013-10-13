<?php

/**
 * Поле шаблон
 *
 * @project SamCMS
 * @package Editor
 * @author Kash
 * @date 26.04.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class TemplateEditor extends Editor {

    /**
     * Путь к шаблону
     * @var string
     */
    protected $tplPath = 'editors/template/template.twig';

    /**
     * Данные для шаблона
     * @var array
     */
    protected $data = array();

    /**
     * Отрисовка html кода
     * @param string $param
     * @return string
     */
    public function render($param) {

        $param->options = $this->getParamOptions($param);
        return parent::render($param);
    }

    /**
     * Возвращает варианты параметра
     *
     * @param $param
     * @return array|bool
     */
    private function getParamOptions($param) {

        if (!isset($param->options)) return false;

        $path = ABS_PATH.$param->options;
        $files = scandir($path);
        $options = array();
        foreach ($files as $file) {

            if ($file[0] != '.') {

                $option = new stdClass();
                $option->value = $file;
                $option->title = $file;
                $option->selected = ($file == $param->default);

                $options[] = $option;
            }
        }

        return $options;
    }
}