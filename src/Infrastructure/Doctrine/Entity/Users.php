<?php

namespace Infrastructure\Doctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
* Users
*
* @ORM\Table(name="users")
* @ORM\Entity
*/
Class Users{
    /**
     * @var int
     *
     * @ORM\Column(name="PR_PKEY", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $user_id;
    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=100, nullable=false)
     */
    private string $firstName;
    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100, nullable=false)
     */
    private string $lastName;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private string $email;
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=100, nullable=false)
     */
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

    public function setId(string $user_id){
        $this->$user_id = $user_id;
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