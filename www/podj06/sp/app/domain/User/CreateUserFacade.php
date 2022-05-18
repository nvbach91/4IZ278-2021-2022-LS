<?php declare(strict_types = 1);

namespace App\Domain\User;

use App\Model\Database\Entity\UserEntity;
use App\Model\Database\EntityManager;
use App\Model\Security\Passwords;

class CreateUserFacade
{

	/** @var EntityManager */
	private $em;

	public function __construct(
		EntityManager $em
	)
	{
		$this->em = $em;
	}

	/**
	 * @param mixed[] $data
	 */
	public function createUser(array $data): UserEntity
	{
		// Create User
		$user = new UserEntity(
			$data['name'],
			$data['surname'],
			$data['email'],
			$data['username'],
			Passwords::create()->hash($data['password'] ?? md5(microtime()))
		);

		// Set role
		if (isset($data['role'])) {
			$user->setRole($data['role']);
		}

		// Save user
		$this->em->persist($user);
		$this->em->flush();

		return $user;
	}

}
