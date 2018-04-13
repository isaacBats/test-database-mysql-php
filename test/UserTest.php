<?php

use PHP\Repository\UserRepository;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function test_all_users()
    {
        $users = new UserRepository();

        $result = $users->all();

        $this->assertInternalType(
            'array',
            $result
        );
    }
}