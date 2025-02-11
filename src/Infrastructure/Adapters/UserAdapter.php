<?php

namespace Infrastructure\Adapters;

use Domain\Gateways\IUserGateway;
use Domain\Entity\User;

Class UserAdapter implements IUserGateway{
    
    public function createUser(User $user){
        return 'insert  new user into database';//TODO: insertion query
    }
}