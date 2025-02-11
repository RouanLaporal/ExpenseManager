<?php

namespace Domain\Request\User;

use Domain\Entity\User;

Class CreateUserRequest{

    protected User $user;

    public function setUserToCreate(User $userToCreate){
        $this->user = $userToCreate;
    }

    public function getUserToCreate() : User{
        return $this->user;
    }

}