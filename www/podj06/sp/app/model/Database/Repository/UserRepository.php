<?php declare(strict_types = 1);

namespace App\Model\Database\Repository;

use App\Model\Database\Entity\UserEntity;

/**
 * @method UserEntity|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method UserEntity|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method UserEntity[] findAll()
 * @method UserEntity[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<UserEntity>
 */
class UserRepository extends AbstractRepository
{

	public function findOneByEmail(string $email): ?UserEntity
	{
		return $this->findOneBy(['email' => $email]);
	}

}
