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
        $userGateway->expects($this->any())
            ->method('findByEmail')
            ->willReturn(null);
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
        $this->test_ShouldFailWhenUserAlreadyExists($userGateway,$request,$createUserUseCase);
        $this->test_ShouldFailWhenUserCreationFails($userGateway,$request,$createUserUseCase);
    }

    private function test_ShouldFailWhenUserAlreadyExists($userGateway, $request, $createUserUseCase){
        
        $userGateway->expects($this->any())
            ->method('findByEmail')
            ->willReturn($request->getUserToCreate());
        $userGateway->expects($this->any())
            ->method('add')
            ->willThrowException(new \Exception('User already exists', 400));
        $expectedResponse = new CreateUserResponse();
        $expectedResponse->setCode(400);
        $expectedResponse->setStatusError();
        $expectedResponse->setMessage('User already exists');
        $response = $createUserUseCase->execute($request);
        
        $this->assertEquals($expectedResponse, $response);
    }

    private function test_ShouldFailWhenUserCreationFails($userGateway,$request,$createUserUseCase){
        
        $userGateway->expects($this->any())
            ->method('findByEmail')
            ->willReturn(null);
        $userGateway->expects($this->any())
            ->method('add')
            ->willThrowException(new \Exception('User creation failed', 500));
        $expectedResponse = new CreateUserResponse();
        $expectedResponse->setCode(500);
        $expectedResponse->setStatusError();
        $expectedResponse->setMessage('User creation failed');
        $response = $createUserUseCase->execute($request);
        
        $this->assertEquals($expectedResponse, $response);
    }
}