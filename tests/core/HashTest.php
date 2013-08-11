<?php
require_once __DIR__ . "/../../loader.php";

/**
 * @project SamCMS
 * @package Test
 * @author Kash
 * @date 06.08.13
 * @copyright Copyright (c) 2013, Kash <deadkash@gmail.com>
 */
class hash_coreTest extends PHPUnit_Framework_TestCase {

    /** @var Hash */
    protected $object;

    protected function setUp() {
        $this->object = new Hash;
    }

    protected function tearDown() {}

    /**
     * Тест конструктора
     * @covers Hash::construct
     */
    public function testConstruct() {
        $this->assertTrue((get_class($this->object->db) == 'DB'));
    }

    /**
     * Тест метода создания ключа
     * @covers Hash::createKey
     */
    public function testCreateKey() {

        $uid = 88; //Идентификатор
        $days = 12; //Количество дней

        //Создаем ключ
        $hash = $this->object->createKey($uid, $days);
        $hashId = (int) $this->object->db->getInsertId();

        //Вытаскиваем его из базы
        $query = "SELECT `id`,`hash`,`uid`,`expire_date`
                    FROM `hash_keys`
                   WHERE `id`=".$hashId.";";
        $this->object->db->setQuery($query);
        $dbHash = $this->object->db->getObject();

        //Проверка совпадения ключа
        $this->assertEquals($hash, $dbHash->hash);

        //Проверка совпадения идентификатора
        $this->assertEquals($uid, $dbHash->uid);

        //Проверка записанной даты
        $currentDate = time();
        $dbDate = strtotime($dbHash->expire_date);
        $this->assertTrue(
            ($dbDate - $currentDate < ($days + 1)*24*60*60) && ($dbDate - $currentDate > ($days-1)*24*60*60)
        );

        //Удаляем созданный ключ
        $this->object->db->delete('hash_keys', 'id', $hashId);
    }

    /**
     * @covers Hash::getIdByHash
     */
    public function testGetIdByHash() {

        $uid = 88; //Идентификатор
        $days = 12; //Количество дней

        //Создаем ключ
        $hash = $this->object->createKey($uid, $days);
        $hashId = (int) $this->object->db->getInsertId();

        $objectHashId = $this->object->getIdByHash($hash);
        $this->assertEquals($uid, $objectHashId);

        //Удаляем созданный ключ
        $this->object->db->delete('hash_keys', 'id', $hashId);
    }

    /**
     * @covers Hash::delHash
     */
    public function testDelHash() {
        
        $uid = 88; //Идентификатор
        $days = 12; //Количество дней

        //Создаем ключ
        $this->object->createKey($uid, $days);
        $hashId = (int) $this->object->db->getInsertId();

        //Удаляем созданный ключ
        $this->object->db->delete('hash_keys', 'id', $hashId);
    }

    /**
     * @covers Hash::delExpired
     */
    public function testDelExpired() {

        //Создаем просроченный ключ
        $uid = 34;
        $query = "INSERT INTO `hash_keys` (`hash`,`uid`,`expire_date`)
                  VALUES ('".md5(time())."', ".$uid.", NOW() + 1 DAY);";
        $this->object->db->query($query);
        $hashId = $this->object->db->getInsertId();

        $this->object->delHash('testHash');

        $query = "SELECT `id` FROM `hash_keys` WHERE `id`=".$hashId.";";
        $this->object->db->setQuery($query);
        $testResult = $this->object->db->getObject();

        $testId = (isset($testResult->id)) ? $testResult->id: false;

        $this->assertEquals(false, $testId);

        //Удаляем созданный ключ
        $this->object->db->delete('hash_keys', 'id', $hashId);
    }
}
