<?php
declare(strict_types=1);

namespace App\Model\Database\Entity;

use App\Model\Database\Entity\Attributes\TId;
use Doctrine\ORM\Mapping as ORM;
use Nette\Utils\Random;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\ApiCredentialsRepository")
 * @ORM\Table(name="api_credentials")
 */
class ApiCredentialsEntity extends AbstractEntity
{
	use TId;

	/** @ORM\Column(type="string", length=255) */
	private string $key;

	/** @ORM\Column(type="string", length=255) */
	private string $secret;

	/** @ORM\Column(type="string", length=255) */
	private string $company;

	/**
	 * @return string
	 */
	public function getKey(): string
	{
		return $this->key;
	}

	/**
	 * @param string $key
	 */
	public function setKey(string $key): void
	{
		$this->key = $key;
	}

	/**
	 * @return string
	 */
	public function getSecret(): string
	{
		return $this->secret;
	}

	/**
	 * @param string $secret
	 */
	public function setSecret(string $secret): void
	{
		$this->secret = $secret;
	}

	/**
	 * @return string
	 */
	public function getCompany(): string
	{
		return $this->company;
	}

	/**
	 * @param string $company
	 */
	public function setCompany(string $company): void
	{
		$this->company = $company;
	}

    public static function create(string $company): self
    {
        $entity = new ApiCredentialsEntity();
        $entity->setCompany($company);
        $entity->setKey(Random::generate());
        $entity->setSecret(Random::generate());

        return $entity;
    }
}
