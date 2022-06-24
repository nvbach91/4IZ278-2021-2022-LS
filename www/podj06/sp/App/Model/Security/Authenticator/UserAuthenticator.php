<?php declare(strict_types = 1);

namespace App\Model\Security\Authenticator;

use App\Model\Database\Entity\UserEntity;
use App\Model\Database\EntityManager;
use App\Model\Exception\Runtime\AuthenticationException;
use App\Model\Security\Passwords;
use Nette\Security\Authenticator;
use Nette\Security\IIdentity;

final class UserAuthenticator implements Authenticator
{	public function __construct(
		private EntityManager $em,
		private Passwords $passwords,
	)
	{

	}

	public function authenticate(string $username, string $password): IIdentity
	{
		$user = $this->em->getUserRepository()->findOneBy(['email' => $username]);

		if ($user === null) {
			throw new AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
		}

		if (!$this->passwords->verify($password, $user->getPasswordHash())) {
			throw new AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
		}

		$this->em->flush();

		return $this->createIdentity($user);
	}

	protected function createIdentity(UserEntity $user): IIdentity
	{
		$this->em->flush();

		return $user->toIdentity();
	}

}
