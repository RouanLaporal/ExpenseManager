<?php

use Domain\Entity\User;
use Domain\Gateways\IUserGateway;
use Domain\Request\User\CreateUserRequest;
use Domain\Response\User\CreateUserResponse;
use Domain\UseCase\User\CreateUserUseCase;
use PHPUnit\Framework\TestCase;

class CreateUserUseCaseTest extends TestCase{

    public function test_executeShouldFinishSuccess(){
        
        $userGateway = $this->createMock(IUserGateway::class);

        $createUserUseCase = new CreateUserUseCase($userGateway);
        $request = new CreateUserRequest();
        $request->setUserToCreate(new User(
            1,
            "Rouan",
            "LAPORAL",
            "rouan.laporal@gmail.com",
            "test"
        ));
        $expectedResponse = new CreateUserResponse();
        $expectedResponse->setStatusSuccess();
        $expectedResponse->setMessage('User successfully created');
        $response = $createUserUseCase->execute($request);
        $this->assertEquals($expectedResponse, $response);
    }

    public function test_executeShouldFailWhenUserCreationFails(){
        $userGateway = $this->createMock(IUserGateway::class);

        $createUserUseCase = new CreateUserUseCase($userGateway);
        $request = new CreateUserRequest();
        $request->setUserToCreate(new User(
            1,
            "Rouan",
            "LAPORAL",
            "rouan.laporal@gmail.com",
            "test"
        ));
        $expectedResponse = new CreateUserResponse();
        $expectedResponse->setStatusError();
        $expectedResponse->setMessage('User creation failed');
        
        $userGateway->expects($this->any())
            ->method('add')
            ->willThrowException(new \Exception('User creation failed', 400));
        
        $response = $createUserUseCase->execute($request);
        
        $this->assertEquals($expectedResponse->getStatus(), $response->getStatus());
        $this->assertEquals($expectedResponse->getMessage(), $response->getMessage());
    }
}