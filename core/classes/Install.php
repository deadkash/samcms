<?php
/**
 * Прототип файла установки компонента или модуля
 *
 * @project SamCMS
 * @package Class
 * @author Kash
 * @since 0.2.4
 * @date 17.08.13
 */

abstract class Install {



    /**
     * Запуск установки
     * @return bool
     */
    public function execute() {
        return true;
    }
}