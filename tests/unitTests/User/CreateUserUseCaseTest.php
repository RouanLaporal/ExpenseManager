<?php

use Domain\Entity\User;
use Domain\Gateways\IUserGateway;
use Domain\Request\User\CreateUserRequest;
use Domain\Response\User\CreateUserResponse;
use Domain\UseCase\User\CreateUserUseCase;
use PHPUnit\Framework\TestCase;

class CreateUserUseCaseTest extends TestCase{

    public function test_executeShouldFinishSuccess(){
        $userToCreate = new User(
            1,
            "Rouan",
            "LAPORAL",
            "rouan.laporal@gmail.com",
            "test"
        );
        $userGateway = $this->createMock(IUserGateway::class);
        $createNewUserUseCase = new CreateUserUseCase($userGateway);
        $request = new CreateUserRequest();
        $request->setUserToCreate($userToCreate);

        $response = $createNewUserUseCase->execute($request);
        $expectedResponse=new CreateUserResponse();
        $expectedResponse->setStatusSuccess();
        $expectedResponse->setSuccessMessage('User created successfully');

        $this->assertEquals($expectedResponse, $response);

    }
}