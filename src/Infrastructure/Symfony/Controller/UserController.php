<?php

namespace Infrastructure\Symfony\Controller;

use Domain\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Domain\Gateways\IUserGateway;
use Domain\Request\User\CreateUserRequest as UserCreateUserRequest;
use Domain\UseCase\User\CreateUserUseCase;
use Infrastructure\Symfony\Presenters\User\CreateUserPresenterToJson;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController{
    
    #[Route('/user/create', name: 'create_user')]
    public function createAction(
        Request $request, 
        IUserGateway $userGateway,
        CreateUserPresenterToJson $createUserPresenterToJson
    ){
        $requestBody = json_decode($request->getContent());
        $createUserRequest = new UserCreateUserRequest();
        $createUserRequest->setUserToCreate(new User(
            $requestBody->id,
            $requestBody->firstName,
            $requestBody->lastName,
            $requestBody->email,
            $requestBody->password
        ));
        $createUserUseCase = new CreateUserUseCase($userGateway);
        $response = $createUserUseCase->execute($createUserRequest);
        return $createUserPresenterToJson->present($response);  
    }
     
}