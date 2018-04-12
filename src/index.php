<?php
/**
 * Script for test in db
 */

namespace PHP;

class Index
{
    private static $pdo;

    const USERNAME = "root";
    const PASSWORD = "mysql";
    const HOST = "127.0.0.1:3307";
    const DB = "magento2";

    /**
     * @return \PDO
     */
    protected function getPDO()
    {
        if (!self::$pdo) {
            $username = self::USERNAME;
            $password = self::PASSWORD;
            $host = self::HOST;
            $db = self::DB;
            
            self::$pdo = new \PDO("mysql:host={$host};dbname={$db}", $username, $password);
        }
        return self::$pdo;
    }
}
