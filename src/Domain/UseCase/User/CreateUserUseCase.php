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

    public function execute(CreateUserRequest $createUserRequest) : CreateUserResponse{
        
        try{
            $response = new CreateUserResponse();
            $userToCreate = $createUserRequest->getUserToCreate();
            $userCreationResponse = $this->userGateway->createUser($userToCreate);//TODO: implement response return
            $response->setStatusSuccess();
            $response->setSuccessMessage('User created successfully');
            return $response;
        }catch(\Exception $e){
            $response = new CreateUserResponse();
            $response->setStatusError();
            $response->setErrorMessage('Error when creating the user');
        }

    }

}