<?php


namespace App\Models;


class User
{


    private string $name;
    private string $surname;
    private string $email;
    private string $password;
    private string $createdAt;
    private ?int $id;

    public function __construct(string $name, string $surname, string $email, string $password, string $createdAt, int $id = null)
    {


        $this->name = $name;
        $this->surname = $surname;
        $this->email=$email;
        $this->password=$password;
        $this->createdAt=$createdAt;
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getId(): int
    {
        return $this->id;
    }

}