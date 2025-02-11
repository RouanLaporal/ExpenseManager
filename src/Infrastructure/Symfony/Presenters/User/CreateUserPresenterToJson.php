<?php

namespace Infrastructure\Symfony\Presenters\User;

use Domain\Response\User\CreateUserResponse;
use Symfony\Component\HttpFoundation\JsonResponse;


class CreateUserPresenterToJson{

    public function present(CreateUserResponse $response){
        $content=(object)[];
        if($response->getStatus()){
            $statusCode=200;
            $content->message = $response->getSuccessMessage();
        }     

        $jsonResponse=new JsonResponse();
        $jsonResponse->setStatusCode($statusCode);
        $jsonResponse->setContent(json_encode($content));
    
        return $jsonResponse;
    }
}