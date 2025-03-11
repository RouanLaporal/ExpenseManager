<?php

namespace Domain\Response\User;

use Domain\Entity\User;

Class CreateUserResponse{

    private User $user;
    private int $code = 200;
    private bool $status;
    private string $message;

    public function setCode($code){
        $this->code = $code;
    }

    public function setStatusSuccess(){
        $this->status = true;
    }

    public function setStatusError(){
        $this->status = false;
    }

    public function setMessage(String $message){
        $this->message = $message;
    }

    public function getCode(){
        return $this->code;
    }

    public function getStatus(){
        return $this->status;
    }

    public function getMessage(){
        return $this->message;
    }

    public function getCreatedUser(): User{
        return $this->user;
    }

}