<?php

namespace Domain\UseCase\User;

use Domain\Gateways\IUserGateway;
use Domain\Request\User\CreateUserRequest;
use Domain\Response\User\CreateUserResponse;

Class CreateUserUseCase{

    public IUserGateway $userGateway;

    public function __construct($userGateway){
        $this->userGateway = $userGateway;
    }

    public function execute(CreateUserRequest $createUserRequest): CreateUserResponse{
        
        try{
            $userToCreate = $createUserRequest->getUserToCreate();  
            $this->userGateway->add($userToCreate);
            $response = new CreateUserResponse();
            $response->setStatusSuccess();
            $response->setMessage('User successfully created');
            return $response;
        }catch(\Exception $e){
            $response = new CreateUserResponse();
            $response->setStatusError();
            $response->setCode($e->getCode());
            $response->setMessage($e->getMessage());
            return $response;
        }

    }

}