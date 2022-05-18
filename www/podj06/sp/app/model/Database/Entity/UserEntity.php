<?php declare(strict_types = 1);

namespace App\Model\Database\Entity;

use App\Model\Database\Entity\Attributes\TCreatedAt;
use App\Model\Database\Entity\Attributes\TId;
use App\Model\Database\Entity\Attributes\TUpdatedAt;
use App\Model\Exception\Logic\InvalidArgumentException;
use App\Model\Security\Identity;
use App\Model\Utils\DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\UserRepository")
 * @ORM\Table(name="`user`")
 * @ORM\HasLifecycleCallbacks
 */
class UserEntity extends AbstractEntity
{

	public const ROLE_ADMIN = 'admin';
	public const ROLE_USER = 'user';

	use TId;
	use TCreatedAt;
	use TUpdatedAt;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=FALSE, unique=false)
	 */
	private string $name;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=FALSE, unique=false)
	 */
	private string $surname;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=FALSE, unique=TRUE)
	 */
	private string $email;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=FALSE, unique=TRUE)
	 */
	private string $username;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=FALSE)
	 */
	private string $passwordHash;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=FALSE)
	 */
	private string $role;

	/**
	 * @var ArrayCollection<int, HousingUnitEntity>
	 * @ORM\OneToMany(targetEntity="HousingUnitEntity", mappedBy="owner")
	 */
	private ArrayCollection $housingUnits;

	public function __construct(string $name, string $surname, string $email, string $username, string $passwordHash)
	{
		$this->name = $name;
		$this->surname = $surname;
		$this->email = $email;
		$this->username = $username;
		$this->passwordHash = $passwordHash;
		$this->housingUnits = new ArrayCollection();

		$this->role = self::ROLE_USER;
	}

	public function getEmail(): string
	{
		return $this->email;
	}

	public function getUsername(): string
	{
		return $this->username;
	}

	public function changeUsername(string $username): void
	{
		$this->username = $username;
	}

	public function getRole(): string
	{
		return $this->role;
	}

	public function setRole(string $role): void
	{
		$this->role = $role;
	}

	public function getPasswordHash(): string
	{
		return $this->passwordHash;
	}

	public function changePasswordHash(string $password): void
	{
		$this->passwordHash = $password;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getSurname(): string
	{
		return $this->surname;
	}

	public function getFullname(): string
	{
		return $this->name . ' ' . $this->surname;
	}

	public function rename(string $name, string $surname): void
	{
		$this->name = $name;
		$this->surname = $surname;
	}

	public function toIdentity(): Identity
	{
		return new Identity($this->getId(), [$this->role], [
			'email' => $this->email,
			'name' => $this->name,
			'surname' => $this->surname,
		]);
	}

}
