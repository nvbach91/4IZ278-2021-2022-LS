<?php
declare(strict_types=1);

namespace App\Domain\Service\Admin;

use App\Model\Database\Entity\UserEntity;
use App\Model\Database\EntityManager;
use App\Model\Security\Passwords;
use Nette\Utils\Random;

class ResetUserPasswordService
{
    public function __construct(
        private EntityManager $entityManager,
    )
    {
    }

    public function reset(UserEntity $entity): string
    {
        $password = Random::generate();
        $entity->setPasswordHash(Passwords::create()->hash($password));

        $this->entityManager->flush();

        return $password;
    }
}
