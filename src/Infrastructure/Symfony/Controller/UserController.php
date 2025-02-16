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
use OpenApi\Attributes as OA;
use OpenApi\Attributes\JsonContent;
use OpenApi\Attributes\Property;

class UserController extends AbstractController{
    
    #[Route('/api/user/create', name: 'create_user', methods: ['POST'])]
    #[OA\RequestBody(
        required: true,
        content: new OA\JsonContent(
            type: 'object',
            properties: [
                new OA\Property(property: 'id', type: 'integer'),
                new OA\Property(property: 'firstName', type: 'string'),
                new OA\Property(property: 'lastName', type: 'string'),
                new OA\Property(property: 'email', type: 'string'),
                new OA\Property(property: 'password', type: 'string')
            ]
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'User created successfully',
        content: new JsonContent(
            type:'string',
            properties: [
                new Property(property:'message', type: 'string', example:'User created successfully')
            ]
        )
    )]
    #[OA\Response(
        response: 400,
        description: 'Invalid input'
    )]
    public function createAction(
        Request $request, 
        IUserGateway $userGateway,
        CreateUserPresenterToJson $createUserPresenterToJson,
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