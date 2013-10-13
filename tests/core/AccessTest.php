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

    /** @var int ID текущего пользователя */
    protected $userId;

    /** @var stdClass объект текущего пользователя */
    protected $user;

    /** @var  Access */
    protected $object;

    /**
     * Перед запуском теста
     * @return void
     */
    protected function setUp() {

        $this->object = new Access;

        //Создаем пользователя
        $user = new stdClass();
        $user->login = 'TestUser';
        $user->password = 'TestUserPassword';
        $user->email = 'testuseremail@testuseremailhost.com';
        $this->user = clone $user;

        $this->userId = $this->object->createUser($user);
        $this->object->activateUser($this->userId);
    }

    /**
     * После запуска теста
     * @return void
     */
    protected function tearDown() {

        //Удаляем пользователя
        $db = DB::create();
        $db->delete('users', 'id', $this->userId);
    }

    /**
     * @covers Access::construct
     */
    public function testConstruct() {
        $this->assertTrue((get_class($this->object->db) == 'DB'));
    }

    /**
     * @covers Access::getAccess
     */
    public function testGetAccess(){

        $sectionId = 799;

        //Незарегистрированному пользователю можно зайти в раздел
        $this->assertEquals(true, $this->object->getAccess($sectionId));

        //Зарегистрированному пользователю можно зайти в раздел
        $this->object->setUserLogIn($this->userId);
        $this->assertEquals(true, $this->object->getAccess($sectionId));
        $this->object->setUserLogOut();

        //Запрещаем вход незарегистрированным пользователям
        $policyId = 4;
        $query = "INSERT INTO `users_policy_deny` (`policy_id`,`section_id`)
                  VALUES (".$policyId.",".$sectionId.");";
        $db = DB::create();
        $db->query($query);
        $denyId = $db->getInsertId();

        $this->assertEquals(false, $this->object->getAccess($sectionId));

        //Разрешаем вход
        $db->delete('users_policy_deny', 'id', $denyId);

        //Запрещаем вход зарегистрированным пользователям
        $policyId = 3;
        $query = "INSERT INTO `users_policy_deny` (`policy_id`,`section_id`)
                  VALUES (".$policyId.",".$sectionId.");";
        $db = DB::create();
        $db->query($query);
        $denyId = $db->getInsertId();

        $this->object->setUserLogIn($this->userId);
        $this->assertEquals(false, $this->object->getAccess($sectionId));

        //Разрешаем вход
        $db->delete('users_policy_deny', 'id', $denyId);
    }

    /**
     * @covers Access::checkAccess
     */
    public function testCheckAccess() {

        $policyId = 16;
        $sectionId = 799;
        $query = "INSERT INTO `users_policy_deny` (`policy_id`,`section_id`)
                  VALUES (".$policyId.",".$sectionId.");";
        $db = DB::create();
        $db->query($query);
        $denyId = $db->getInsertId();

        $this->assertEquals(false, $this->object->checkAccess($sectionId, $policyId));
        $this->assertEquals(true, $this->object->checkAccess(800, 13));

        $db->delete('users_policy_deny', 'id', $denyId);
    }

    /**
     * @covers Access::getUser
     */
    public function testGetUser() {

        $objectUser = $this->object->getUser($this->userId);
        $this->assertEquals($this->user->login, $objectUser->login);
    }

    /**
     * @covers Access::getCurrentUser
     */
    public function testGetCurrentUser() {

        $this->object->setUserLogIn($this->userId);
        $objectUser = $this->object->getCurrentUser();
        $this->assertEquals($this->user->login, $objectUser->login);
    }

    /**
     * @covers Access::checkLogin
     */
    public function testCheckLogin() {

        $this->assertEquals($this->userId, $this->object->checkLogin($this->user->login, $this->user->password));
        $this->assertEquals(false, $this->object->checkLogin('blabla', 'passblaword'));
    }

    /**
     * @covers Access::preparePassword
     */
    public function testPreparePassword() {

        $lgn = 'MyLogin';
        $pwd = 'MyPassword';
        $hash = md5($lgn.'_|_'.$pwd);

        $this->assertEquals($hash, $this->object->preparePassword($pwd, $lgn));
    }

    /**
     * @covers Access::setUserLogIn
     */
    public function testSetUserLogIn() {

        $this->object->setUserLogIn($this->userId);
        $objectUser = $this->object->getCurrentUser();
        $this->assertEquals($this->userId, $objectUser->id);
    }

    /**
     * @covers Access::setUserLogOut
     */
    public function testSetUserLogOut() {

        $this->object->setUserLogIn($this->userId);
        $objectUser = $this->object->getCurrentUser();
        $this->assertEquals($this->userId, $objectUser->id);
        $this->object->setUserLogOut();
        $objectUser = $this->object->getCurrentUser();
        $this->assertEquals(false, $objectUser);
    }

    /**
     * @covers Access::loginExists
     */
    public function testLoginExists(){

        $this->assertEquals($this->userId, $this->object->loginExists($this->user->login));
        $this->assertEquals(false, $this->object->loginExists('ThisLoginProbablyNotExists'));
    }

    /**
     * @covers Access::createUser
     */
    public function testCreateUser(){

        $objectUser = $this->object->getUser($this->userId);
        $this->assertEquals($this->userId, $objectUser->id);
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

        $pass1 = 'VeryLongPassword';
        $pass2 = 'vlp';

        $this->assertEquals(true, $this->object->checkPassMinLength($pass1));
        $this->assertEquals(false, $this->object->checkPassMinLength($pass2));
    }

    /**
     * @coveres Access::activateUser
     */
    public function testActivateUser(){

        $db = DB::create();
        $query = "UPDATE `users`
                     SET `active`=0
                   WHERE `id`=".$this->userId.";";
        $db->query($query);

        $this->assertEquals(false, $this->object->checkLogin($this->user->login, $this->user->password));
        $this->object->activateUser($this->userId);
        $this->assertEquals($this->userId, $this->object->checkLogin($this->user->login, $this->user->password));
    }

    /**
     * @covers Access::existEmail
     */
    public function testExistEmail(){

        $this->assertEquals($this->userId, $this->object->existEmail($this->user->email));
        $this->assertEquals(false, $this->object->existEmail('thisemailprobablynotexists@tlen.com'));
    }

    /**
     * @coveres Access::changePassword
     */
    public function testChangePassword(){

        $this->assertEquals($this->userId, $this->object->checkLogin($this->user->login, $this->user->password));

        $newPassword = 'NewTestUserPassword';
        $this->object->changePassword($this->userId, $newPassword);

        $this->assertEquals(false, $this->object->checkLogin($this->user->login, $this->user->password));
        $this->assertEquals($this->userId, $this->object->checkLogin($this->user->login, $newPassword));
    }
}
