<?php

namespace Domain\Gateways;

use Domain\Entity\User;

interface IUserGateway{
    public function createUser(User $user);
}
    

