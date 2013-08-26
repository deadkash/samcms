<?php
require_once __DIR__ . "/../../loader.php";
/**
 *
 *
 * @project SamCMS
 * @package Test
 * @author Kash
 * @date 26.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */

class FieldsTest extends PHPUnit_Framework_TestCase {

    protected $object;

    protected function setUp(){
        $this->object = new Fields();
    }

    /**
     * @covers Fields::construct
     */
    public function testConstruct() {
        $this->assertTrue((get_class($this->object) == 'Fields'));
    }
}
