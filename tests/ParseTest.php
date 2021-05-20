<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use \PHPUnit\Framework\TestCase;
use \mharj\MySqlConfig;

final class ParseTest extends TestCase
{
    public function testConfigDefaults(): void
    {
        $data = new MySqlConfig();
        $this->assertIsObject($data);
        $this->assertEquals($data->hostname, 'localhost');
        $this->assertEquals($data->username, 'root');
        $this->assertEquals($data->password, '');
        $this->assertEquals($data->database, 'mysql');
        $this->assertEquals($data->port, '3306');
    }
    public function testParseFromUri(): void
    {
        $data = MySqlConfig::parseFromUri("mysql://username:password@server/db");
        $this->assertIsObject($data);
        $this->assertEquals($data->hostname, 'server');
        $this->assertEquals($data->username, 'username');
        $this->assertEquals($data->password, 'password');
        $this->assertEquals($data->database, 'db');
        $this->assertEquals($data->port, '3306');
    }
    public function testUrlDecodeParseFromUri(): void
    {
        $data = MySqlConfig::parseFromUri("mysql://user%40name:pass%40word@server/db");
        $this->assertIsObject($data);
        $this->assertEquals($data->hostname, 'server');
        $this->assertEquals($data->username, 'user@name');
        $this->assertEquals($data->password, 'pass@word');
        $this->assertEquals($data->database, 'db');
        $this->assertEquals($data->port, '3306');
    }
    public function testParseEmptyFromUri(): void
    {
        $data = MySqlConfig::parseFromUri("");
        $this->assertIsObject($data);
        $this->assertEquals($data->hostname, 'localhost');
        $this->assertEquals($data->username, 'root');
        $this->assertEquals($data->password, '');
        $this->assertEquals($data->database, 'mysql');
        $this->assertEquals($data->port, '3306');
    }
}
