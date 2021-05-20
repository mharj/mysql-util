<?php

namespace mharj;

/**
 * @property string $hostname hostname
 * @property string $port port number
 * @property string $username username
 * @property string $password password
 * @property string $database database
 */
class MySqlConfig
{
    function __construct($hostname = 'localhost', $port = '3306', $username = 'root', $password = '', $database = 'mysql')
    {
        $this->hostname = $hostname;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }
    /**
     * @return MysqlConfig
     */
    public static function parseFromUri($variable)
    {
        $parts = parse_url($variable);
        foreach($parts as $name => $value) {
            $parts[$name] = urldecode($value);
        }
        $data = array_merge(
            [
                'host' => 'localhost',
                'port' => '3306',
                'user' => 'root',
                'pass' => '',
                'path' => '/mysql',
            ],
            array_filter($parts),
        );
        return new MysqlConfig($data['host'], '' . $data['port'], $data['user'], $data['pass'], ltrim($data['path'], '/'));
    }
}
