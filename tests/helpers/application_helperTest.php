<?php
require_once __DIR__ . "../../../loader.php";

/**
 * @project SamCMS
 * @package Test
 * @author Kash
 * @date 06.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class application_helperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ApplicationHelper
     */
    protected $object;

    /**
     * Метод, вызываемый до начала теста
     */
    protected function setUp()
    {
        $this->object = new ApplicationHelper;
    }

    /**
     * Метод, вызываемый после завершения теста
     */
    protected function tearDown()
    {
    }

    /**
     * Проверка генерации пути до модуля
     *
     * @covers application_helper::getModulePath
     */
    public function testGetModulePath()
    {
        $this->assertSame('modules/str/str.php',ApplicationHelper::getModulePath('str'));
    }
}