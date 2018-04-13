<?php

require 'index.php';

use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    public function test_connect_database()
    {
        $pdo = getPDO();
        $this->assertInstanceOf(\PDO::class, $pdo);
        if ($pdo instanceof \PDO) {
            execScript($pdo);
        }

        $stmt = $pdo->prepare('SELECT * FROM users');
        $stmt->execute();
        $users = $stmt->fetchAll();
        $this->assertInternalType('array', $users);
        $pdo->exec('DROP database tests');
    }
}
