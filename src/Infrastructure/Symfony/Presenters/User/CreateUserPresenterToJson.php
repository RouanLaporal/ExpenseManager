<?php

namespace Infrastructure\Symfony\Presenters\User;

use Domain\Response\User\CreateUserResponse;
use Symfony\Component\HttpFoundation\JsonResponse;


class CreateUserPresenterToJson{

    public function present(CreateUserResponse $response){
        if($response->getStatus()){
            $statusCode=$response->getCode();
            $content = $response->getMessage();
        }else{
            $statusCode=$response->getCode();
            $content = $response->getMessage();
        }    

        $jsonResponse=new JsonResponse();
        $jsonResponse->setStatusCode($statusCode);
        $jsonResponse->setContent(json_encode($content));
    
        return $jsonResponse;
    }
}