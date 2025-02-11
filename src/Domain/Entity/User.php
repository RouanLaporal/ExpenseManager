<?php

namespace Domain\Entity;

Class User{
    
    private $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;

    public function __construct(
        string $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password 
    ) {
        $this->email = $email;
        $this->password = $password;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->id = $id;
    }

}