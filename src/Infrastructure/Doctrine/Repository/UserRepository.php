<?php
 
namespace Infrastructure\Doctrine\Repository;
 
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Entity\User;
use Domain\Gateways\IUserGateway;
use Infrastructure\Doctrine\Entity\Users;
 
class UserRepository extends ServiceEntityRepository implements IUserGateway
{
 
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }
 
    public function add(User $newUser): void{
        try{
            $users=new Users($newUser);

            if($this->findByEmail($newUser->getEmail())){
                throw new \Exception('User already exists', 400);
            }
        
            $entityManager = $this->getEntityManager();
            $entityManager->persist($users);
            $entityManager->flush();
        }catch(\Exception $e){
            throw new \Exception("User creation failed : ". $e->getMessage(), 500);
        }
    }

    public function findByEmail(string $email): ?User{
        $user = $this->findOneBy(['email' => $email]);
        if($user){
            return new User(
                $user->getId(),
                $user->getFirstName(),
                $user->getLastName(),
                $user->getEmail(),
                $user->getPassword()
            );
        }
        return null;
    }

    
}