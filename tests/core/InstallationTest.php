<?php
require_once __DIR__ . "/../../loader.php";

/**
 * Тест для библиотеки установки
 *
 * @project SamCMS
 * @package 
 * @author Kash
 * @date 26.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class InstallationTest extends PHPUnit_Framework_TestCase {

    /** @var Installation */
    protected $object;

    protected function setUp(){
        $this->object = Installation::create();
    }

    /**
     * @covers Installation::construct
     */
    public function testConstruct() {
        $this->assertTrue((get_class($this->object) == 'Installation'));
    }
    
    
}
