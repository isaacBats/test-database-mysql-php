<?php
namespace PHP\Repository;

class UserRepository extends BaseRepository
{
    protected function table()
    {
        return 'users';
    }

    protected function mapEntity(array $result)
    {
        return $result;
    }

    public function all()
    {
        $pdo = $this->getPDO();
        $statement = $pdo->prepare('SELECT * FROM users');
        
        $statement->execute();
        return $statement->fetchAll();
    }
}
