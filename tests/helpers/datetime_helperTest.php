<?php
require_once __DIR__ . "../../../loader.php";

/**
 * @project SamCMS
 * @package Test
 * @author Kash
 * @date 06.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class datetime_helperTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var DatetimeHelper
     */
    protected $object;

    /**
     * Метод, вызываемый до начала теста
     */
    protected function setUp()
    {
        $this->object = new DatetimeHelper;
    }

    /**
     * Метод, вызываемый после завершения теста
     */
    protected function tearDown()
    {
    }

    /**
     * Тест генерации красивой даты
     *
     * @covers datetime_helper::prepareDate
     */
    public function testPrepareDate()
    {
        $this->assertEquals(
          '12 сентября 2012 г.',
          DatetimeHelper::prepareDate('2012-09-12 12:34:00')
        );
    }
}
