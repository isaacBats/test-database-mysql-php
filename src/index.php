<?php

require_once __DIR__ . '/../vendor/autoload.php';


$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

/**
 * @return \PDO
 */
function getPDO()
{
    $username = getenv('PROD_DB_USERNAME');
    $password = getenv('PROD_DB_PASSWORD');
    $host = getenv('PROD_DB_HOST');
    $db = getenv('PROD_DB_NAME');
    
    echo "<h1>Connection on DataBase: {$db}</h1>";
    echo "<hr>";
    echo "<p>Endpoint: " . hiddenString($host) . "</p>";
    echo "<p>Username: {$username}</p>";

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

function hiddenString($str, $start = 10, $end = 15)
{
    $len = strlen($str);
    return substr($str, 0, $start) . str_repeat('*', $len - ($start + $end)) . substr($str, $len - $end, $end);
}

function execScript($pdo)
{
    $fp = fopen(__DIR__ . '/../db/creates.sql', 'r');
    while (!feof($fp)) {
        $linea = fgets($fp);
        $pdo->exec($linea);
        // echo PHP_EOL;
    }
    fclose($fp);
}

try {
    $pdo = getPDO();
    if ($pdo instanceof \PDO) {
        execScript($pdo);
    }
    $stmt = $pdo->prepare('SELECT * FROM users');
    $stmt->execute();
    $users = $stmt->fetchAll();
    echo '<pre>'; print_r($users);
    $pdo->exec('DROP database tests');
} catch (\Exception $e) {
    echo "Don't get users, error: {$e->getMessage()}";
}
