<?php
require_once __DIR__ . "/../../loader.php";

/**
 * @project SamCMS
 * @package Test
 * @author Kash
 * @date 06.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class AccessTest extends PHPUnit_Framework_TestCase {

    /** @var  Access */
    protected $object;

    protected function setUp() {
        $this->object = new Access;
    }

    protected function tearDown() {}

    /**
     * @covers Access::construct
     */
    public function testConstruct() {
        $this->assertTrue((get_class($this->object->db) == 'DB'));
    }

    /**
     * @covers Access::setDefaultPolicy
     */
    public function testSetDefaultPolicy(){
        $this->markTestIncomplete();
    }

    /**
     * @covers Access::getAccess
     */
    public function testGetAccess(){

        $this->markTestIncomplete();
    }

    /**
     * @covers Access::checkAccess
     */
    public function testCheckAccess() {

        //Создаем раздел, к которому хотим проверить доступ

        //Создаем тестовую группу пользователей

        //Разрешаем доступ к разделу

        //Проверяем доступ

        //Запрещаем доступ к разделу

        //Проверяем доступ

        //Удаляем раздел

        //Удаляем тестовую группу

        $this->markTestIncomplete();
    }

    /**
     * @covers Access::getUser
     */
    public function testGetUser() {
        $this->markTestIncomplete();
    }

    /**
     * @covers Access::getCurrentUser
     */
    public function testGetCurrentUser() {
        $this->markTestIncomplete();
    }

    /**
     * @covers Access::checkLogin
     */
    public function testCheckLogin() {
        $this->markTestIncomplete();
    }

    /**
     * @covers Access::preparePassword
     */
    public function testPreparePassword() {
        $this->markTestIncomplete();
    }

    /**
     * @covers Access::setUserLogIn
     */
    public function testSetUserLogIn() {
        $this->markTestIncomplete();
    }

    /**
     * @covers Access::setUserLogOut
     */
    public function testSetUserLogOut() {
        $this->markTestIncomplete();
    }

    /**
     * @covers Access::loginExists
     */
    public function testLoginExists(){
        $this->markTestIncomplete('Закончи меня');
    }

    /**
     * @covers Access::createUser
     */
    public function testCreateUser(){
        $this->markTestIncomplete();
    }

    /**
     * @covers Access::checkPasswords
     */
    public function testCheckPasswords(){

        $this->assertEquals(false, $this->object->checkPasswords('pass1','pass2'));
        $this->assertEquals(true, $this->object->checkPasswords('pass1','pass1'));
    }

    /**
     * @covers Access::checkPassMinLength
     */
    public function testCheckPassMinLength(){
        $this->markTestIncomplete();
    }

    /**
     * @coveres Access::activateUser
     */
    public function testActivateUser(){
        $this->markTestIncomplete();
    }

    /**
     * @covers Access::existEmail
     */
    public function testExistEmail(){
        $this->markTestIncomplete();
    }

    /**
     * @coveres Access::changePassword
     */
    public function testChangePassword(){
        $this->markTestIncomplete();
    }
}
