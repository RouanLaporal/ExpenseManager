<?php

namespace Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Domain\Entity\AbstractEntity;
use Infrastructure\Doctrine\Repository\UserRepository;
use Domain\Entity\User;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: "users")]
Class Users extends AbstractEntity{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private $user_id;
    #[ORM\Column(name: "first_name", length: 255, nullable: false)]
    private string $firstName;
    #[ORM\Column(name: "last_name",length: 255, nullable: false)]
    private string $lastName;
    #[ORM\Column(length: 255, nullable: false)]
    private string $email;
    #[ORM\Column(length: 255, nullable: false)]
    private string $password;

    public function __construct(array $user){
       $this->hydrate($user);   
    }

    public function getId(){
        return $this->user_id;
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
}