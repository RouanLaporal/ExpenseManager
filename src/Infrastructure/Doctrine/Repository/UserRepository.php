<?php
 
namespace Infrastructure\Doctrine\Repository;
 
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Entity\User;
use Domain\Gateways\IUserGateway;
use Domain\Response\User\CreateUserResponse;
use Infrastructure\Doctrine\Entity\Users;
 
class UserRepository extends ServiceEntityRepository implements IUserGateway
{
 
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }
 
    public function add(User $newUser): void{
        try{
        
            $users=new Users((array)$newUser);
        
            $entityManager = $this->getEntityManager();
            $entityManager->persist($users);
            $entityManager->flush();
        }catch(\Exception $e){
            throw new \Exception('User creation failed', 500);
        }
    }

    
}