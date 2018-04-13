<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * @return \PDO
 */
function getPDO()
{
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    $host = getenv('DB_HOST');
    $db = getenv('DB_NAME');
        
    try {
        return new \PDO(
            "mysql:host={$host};dbname={$db}",
            $username,
            $password,
            array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
        );
    } catch (\PDOException $e) {
        echo "Can't open the database, error: {$e->getMessage()}";
    }
}

try {
    $pdo = getPDO();
    $stmt = $pdo->prepare('SELECT * FROM users');
    $stmt->execute();
    $users = $stmt->fetchAll();
    echo '<pre>'; print_r($users);
} catch (\Exception $e) {
    echo "Don't get users, error: {$e->getMessage()}";
}
