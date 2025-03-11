<?php

namespace Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Infrastructure\Doctrine\Repository\UserRepository;

#[ORM\Entity(repositoryClass: UserRepository::class)]
Class Users{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $user_id;
    #[ORM\Column(length: 255)]
    private string $firstName;
    #[ORM\Column(length: 255)]
    private string $lastName;
    #[ORM\Column(length: 255)]
    private string $email;
    #[ORM\Column(length: 255)]
    private string $password;

    public function __construct(array $dataList = []) {
        if(count($dataList)>0){
            foreach($dataList as $field => $value){
                 if(property_exists($this,$field)){
                     $this->$field = $value;
                 }
             }
         }
    }

    public function getId() : ?int{
       return $this->user_id;
    }

    public function getFirstName() : ?string{
        return $this->firstName;
    }

    public function getLastName() : ?string{
        return $this->lastName;
    }
    public function getEmail() : ?string{
        return $this->email;
    }
    public function getPassword() : ?string{
        return $this->password;
    }
}