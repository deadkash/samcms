<?php
require_once __DIR__ . "/../../loader.php";

/**
 * @project SamCMS
 * @package Test
 * @author Kash
 * @date 06.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class RequestTest extends PHPUnit_Framework_TestCase {

    /** @var Request */
    protected $object;

    protected function setUp() {
        $this->object = new Request();
    }

    /**
     * @covers Request::getInt
     */
    public function testGetInt() {

        $_GET['test1'] = 15;
        $_GET['test2'] = 'error';

        $_POST['test4'] = 75;
        $_POST['test5'] = 'error2';

        $this->assertEquals(15, $this->object->getInt('test1'));
        $this->assertEquals(0, $this->object->getInt('test2'));
        $this->assertEquals(42, $this->object->getInt('test3', 42));
        $this->assertEquals(75, $this->object->getInt('test4'));
        $this->assertEquals(0, $this->object->getInt('test5'));
    }

    /**
     * @covers Request::getStr
     */
    public function testGetStr(){

        $_GET['test1'] = 15;
        $_GET['test2'] = 'error';

        $_POST['test4'] = 75;
        $_POST['test5'] = 'error2';

        $this->assertEquals(15, $this->object->getStr('test1'));
        $this->assertEquals('error', $this->object->getStr('test2'));
        $this->assertEquals('test15', $this->object->getStr('test3', 'test15'));
        $this->assertEquals(75, $this->object->getStr('test4'));
        $this->assertEquals('error2', $this->object->getStr('test5'));
    }

    /**
     * @covers Request::setGet
     */
    public function testSetGet(){
        $this->markTestIncomplete();
    }

    /**
     * @covers Request::setPost
     */
    public function testSetPost(){
        $this->markTestIncomplete();
    }

    /**
     * @covers Request::getPostStr
     */
    public function testGetPostStr(){
        $this->markTestIncomplete();
    }

    /**
     * @covers Request::getGetStr
     */
    public function testGetGetStr(){
        $this->markTestIncomplete();
    }

    /**
     * @covers Request::getFile
     */
    public function testGetFile(){
        $this->markTestSkipped();
    }
}
