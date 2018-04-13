<?php
namespace PHP\Repository;

abstract class BaseRepository
{
    private static $pdo;
    const USERNAME = "root";
    const PASSWORD = "mysql";
    const HOST = "127.0.0.1:3307";
    const DB = "magento2";

    /**
     * @return string
     */
    abstract protected function table();

    /**
     * @param array $result
     * @return object
     */
    abstract protected function mapEntity(array $result);

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

    public function find($id)
    {
        $pdo = $this->getPDO();

        $statement = $pdo->prepare(
            'SELECT * FROM '.$this->table().' WHERE id = :id'
        );

        $statement->bindParam(':id', $id, \PDO::PARAM_INT);

        $statement->execute();
        $result = $statement->fetch();

        if ($result === false) {
            throw new \OutOfBoundsException("{$this->table()}: {$id} does not exist.");
        }

        return $this->mapEntity($result);
    }
}
