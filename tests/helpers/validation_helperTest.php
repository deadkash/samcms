<?php
require_once __DIR__ . "../../../loader.php";

/**
 * @project SamCMS
 * @package Test
 * @author Kash
 * @date 06.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class validation_helperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ValidationHelper
     */
    protected $object;

    /**
     * Метод, вызываемый до начала теста
     */
    protected function setUp()
    {
        $this->object = new ValidationHelper;
    }

    /**
     * Метод, вызываемый после завершения теста
     */
    protected function tearDown()
    {
    }

    /**
     * Generated from @assert ('deadkash@gmail.com') == 'deadkash@gmail.com'
     *
     * @covers validation_helper::checkEmail
     */
    public function testCheckEmail()
    {
        $this->assertEquals('deadkash@gmail.com',
          ValidationHelper::checkEmail('deadkash@gmail.com')
        );
    }

    /**
     * Generated from @assert ('test.test.ru') == false.
     *
     * @covers validation_helper::checkEmail
     */
    public function testCheckEmail2()
    {
        $this->assertFalse(
          ValidationHelper::checkEmail('test.test.ru')
        );
    }

    /**
     * Generated from @assert ('test@test') == false.
     *
     * @covers validation_helper::checkEmail
     */
    public function testCheckEmail3()
    {
        $this->assertFalse(
          ValidationHelper::checkEmail('test@test')
        );
    }

    /**
     * Generated from @assert ('тест@тест.ру') == false.
     *
     * @covers validation_helper::checkEmail
     */
    public function testCheckEmail4()
    {
        $this->assertFalse(
          ValidationHelper::checkEmail('тест@тест.ру')
        );
    }
}