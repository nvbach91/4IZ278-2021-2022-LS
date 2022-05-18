<?php declare(strict_types = 1);

namespace App\Model\Database;

use App\Model\Database\Entity\UserEntity;
use App\Model\Database\Repository\UserRepository;

/**
 * @mixin EntityManager
 */
trait TRepositories
{

	public function getUserRepository(): UserRepository
	{
		return $this->getRepository(UserEntity::class);
	}

}
