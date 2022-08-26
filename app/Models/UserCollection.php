<?php

namespace App\Models;

class UserCollection
{
    private array $users = [];

    public function __construct(array $users)
    {
        foreach ($users as $user) {
            $this->addUser($user);
        }
    }
    public function addUser(User  $user): void
    {
        $this->users[] = $user;
    }
    public function getUsers(): array
    {
       return $this->users;
    }
}