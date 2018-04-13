<?php

require_once __DIR__ . '/../vendor/autoload.php';

echo 'Hola<pre>';

define('USERNAME', "root");
define('PASSWORD', "mysql");
define('HOST', "127.0.0.1:3307");
define('DB', "magento2");

var_dump($_SERVER);
echo 'variable host: ' . getenv('DB_HOST'); exit(0);
/**
 * @return \PDO
 */
function getPDO()
{
    $username = USERNAME;
    $password = PASSWORD;
    $host = HOST;
    $db = DB;
        
    return new \PDO("mysql:host={$host};dbname={$db}", $username, $password);
}

try {
    $pdo = getPDO();

} catch (\Exception $e) {
    echo $e->getMessage();
}
