<?php
/**
 *
 *
 * @project SamCMS
 * @package 
 * @author Kash
 * @version 0.2.1
 * @date 24.08.13
 */

class BuilderConsts {

    /**
     * Возвращает поля БД
     * @return array
     */
    public static function getDBFields(){

        $fields = array();

        $dbhost = new Field();
        $dbhost->setName('dbhost')
               ->setTitle('install_config_dbhost')
               ->setType('text')
               ->setDefault('localhost')
               ->setRequired(true);
        $fields[] = $dbhost;

        $dbuser = new Field();
        $dbuser->setName('dbuser')
               ->setTitle('install_config_dbuser')
               ->setType('text')
               ->setRequired(true);
        $fields[] = $dbuser;

        $dbpass = new Field();
        $dbpass->setName('dbpass')
               ->setTitle('install_config_dbpass')
               ->setType('password')
               ->setRequired(true);
        $fields[] = $dbpass;

        $dbname = new Field();
        $dbname->setName('dbname')
               ->setTitle('install_config_dbname')
               ->setType('text')
               ->setRequired(true);
        $fields[] = $dbname;

        return $fields;
    }

    /**
     * Возвращает поля пользователя
     * @return array
     */
    public static function getUserFields(){

        $fields = array();

        $login = new Field();
        $login->setName('login')
              ->setType('text')
              ->setTitle('install_user_login')
              ->setRequired(true)
              ->setValidation('latin')
              ->setDescription('install_user_login_desc');
        $fields[] = $login;

        $email = new Field();
        $email->setName('email')
              ->setType('text')
              ->setTitle('E-mail')
              ->setRequired(true)
              ->setValidation('email');
        $fields[] = $email;

        $password = new Field();
        $password->setName('password')
                 ->setType('password')
                 ->setTitle('install_user_pass')
                 ->setRequired(true);
        $fields[] = $password;

        $passwordConfirm = new Field();
        $passwordConfirm->setName('confirm_password')
                        ->setType('password')
                        ->setTitle('install_user_pass_confirm')
                        ->setRequired(true);
        $fields[] = $passwordConfirm;

        return $fields;
    }

    /**
     * Возвращает поля параметры
     * @return array
     */
    public static function getParamsFields(){

        $fields = array();

        $metaTitle = new Field();
        $metaTitle->setName('meta_title')
                  ->setType('textarea')
                  ->setTitle('install_params_metatitle');
        $fields[] = $metaTitle;

        $metaKeywords = new Field();
        $metaKeywords->setName('meta_keywords')
                     ->setType('textarea')
                     ->setTitle('install_params_metakeywords');
        $fields[] = $metaKeywords;

        $metaDescription = new Field();
        $metaDescription->setName('meta_description')
                        ->setType('textarea')
                        ->setTitle('install_params_metadescription');
        $fields[] = $metaDescription;

        return $fields;
    }
}