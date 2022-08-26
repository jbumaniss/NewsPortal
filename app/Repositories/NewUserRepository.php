<?php


namespace App\Repositories;


use App\Models\User;
use App\Models\UserCollection;
use App\Services\StoreUserServiceRequest;
use Doctrine\DBAL\Connection;


class NewUserRepository implements UserRepository
{

    private function db (): Connection
    {
        $connectionParams = [
            'dbname' => $_ENV['DBNAME'],
            'user' => $_ENV['USER'],
            'password' => $_ENV['PASSWORD'],
            'host' => $_ENV['HOST'],
            'driver' => $_ENV['DRIVER'],
        ];
        return  \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    }

    public function requestUsers(): UserCollection
    {

        $conn = self::db();
        $queryBuilder = $conn->createQueryBuilder();
        $mySqlResponse = $queryBuilder->select('*')
            ->from('users')
            ->fetchAllAssociative();

        $users = [];
        foreach ($mySqlResponse as $user) {
            $users[] = new User(
                $user['name'],
                $user['surname'],
                $user['email'],
                $user['password'],
                $user['createdAt'],
                $user['id']
            );
        }
        return new UserCollection($users);
    }



    public function save(StoreUserServiceRequest $newUser): void
    {
        $name = $newUser->getName();
        $surname = $newUser->getSurname();
        $email = $newUser->getEmail();
        $password = $newUser->getPassword();


        $conn = self::db();
        $conn->insert('users', [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'password' => $password,
        ]);
    }

}