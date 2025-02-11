<?php

namespace Domain\Response\User;

use Domain\Entity\User;

Class CreateUserResponse{

    private User $user;
    private bool $status;
    private string $message;



    public function setStatusSuccess(){
        $this->status = true;
    }

    public function setStatusError(){
        $this->status = false;
    }

    public function setSuccessMessage(String $message){
        $this->message = $message;
    }

    public function setErrorMessage(String $message){
        $this->message = $message;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getSuccessMessage(){
        return $this->message;
    }

    public function getCreatedUser(): User{
        return $this->user;
    }

}