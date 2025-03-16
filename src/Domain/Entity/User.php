<?php

namespace Domain\Entity;

Class User extends AbstractEntity{
    
    private $userId;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;

    public function __construct(
        array $data = []
    ) {
       $this->hydrate($data);
    }

    public function getId(){
        return $this->userId;
    }
    public function getFirstName() : string{
        return $this->firstName;
    }

    public function getLastName() : string{
        return $this->lastName;
    }
    public function getEmail() : string{
        return $this->email;
    }
    public function getPassword() : string{
        return $this->password;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}