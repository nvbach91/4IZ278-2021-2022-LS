<?php declare(strict_types = 1);

namespace App\Model\Security\Authorizator;

use App\Model\Database\Entity\UserEntity;
use Nette\Security\Permission;

final class StaticAuthorizator extends Permission
{

	/**
	 * Create ACL
	 */
	public function __construct()
	{
		$this->addRoles();
		$this->addResources();
		$this->addPermissions();
	}

	/**
	 * Setup roles
	 */
	protected function addRoles(): void
	{
		$this->addRole(UserEntity::ROLE_ADMIN);
	}

	/**
	 * Setup resources
	 */
	protected function addResources(): void
	{
		$this->addResource('Admin:Home');
	}

	/**
	 * Setup ACL
	 */
	protected function addPermissions(): void
	{
		$this->allow(UserEntity::ROLE_ADMIN, [
			'Admin:Home',
		]);
	}

}
