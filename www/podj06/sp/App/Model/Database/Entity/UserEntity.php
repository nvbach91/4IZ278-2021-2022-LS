<?php declare(strict_types = 1);

namespace App\Model\Database\Entity;

use App\Model\Database\Entity\Attributes\TCreatedAt;
use App\Model\Database\Entity\Attributes\TId;
use App\Model\Database\Entity\Attributes\TUpdatedAt;
use App\Model\Exception\Logic\InvalidArgumentException;
use App\Model\Security\Identity;
use App\Model\Utils\DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
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
	 * @ORM\Column(type="string", length=255, nullable=FALSE)
	 */
	private string $passwordHash;

	/**
	 * @var string
	 * @ORM\Column(type="string", length=255, nullable=FALSE)
	 */
	private string $role;

    /** @var string
     * @ORM\Column(type="string", length=255)
     */
    private string $phone;

	/**
	 * @var Collection<int, HousingUnitEntity>
	 * @ORM\OneToMany(targetEntity="HousingUnitEntity", mappedBy="owner")
	 */
	private Collection $housingUnits;

	/** @var Collection<int, AnnouncementEntity>
	 *	@ORM\OneToMany(targetEntity="AnnouncementEntity", mappedBy="user", cascade={"persist", "remove"})
     *  @ORM\OrderBy({"id" = "ASC"})
	 */
	private Collection $announcements;

    /** @var Collection<int, PollEntity>
     * @ORM\OneToMany(targetEntity="PollEntity", mappedBy="author")
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private Collection $polls;

    /** @var Collection<int, UserVoteEntity>
     * @ORM\OneToMany(targetEntity="UserVoteEntity", mappedBy="user", cascade={"persist", "remove"})
     */
    private Collection $votes;

	public function __construct(string $name, string $surname, string $email, string $phone, string $passwordHash)
	{
		$this->name = $name;
		$this->surname = $surname;
		$this->email = $email;
		$this->passwordHash = $passwordHash;
		$this->housingUnits = new ArrayCollection();
		$this->announcements = new ArrayCollection();
        $this->phone = $phone;

		$this->role = self::ROLE_USER;
	}

    public function getAnnouncements(): Collection
    {
        return $this->announcements;
    }

	public function getEmail(): string
	{
		return $this->email;
	}

	public function getRole(): string
	{
		return $this->role;
	}

	public function setRole(string $role): void
	{
		$this->role = $role;
	}

    public function isAdministrator(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function setAdmin(bool $admin = true): void
    {
        $this->role = $admin ? self::ROLE_ADMIN : self::ROLE_USER;
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

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $surname
     */
    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
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

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function setPasswordHash(string $hash): void
    {
        $this->passwordHash = $hash;
    }

    /**
     * @return Collection
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function setVotes(Collection $votes): void
    {
        $this->votes = $votes;
    }

	public function toIdentity(): Identity
	{
		return new Identity($this->getId(), [$this->role], [
			'email' => $this->email,
			'name' => $this->name,
			'surname' => $this->surname,
		]);
	}

    public function getTotalVotes(): int
    {
        $count = 0;
        $this->housingUnits->forAll(function($key, HousingUnitEntity $entity) use (&$count) {
            $count += $entity->getVotesShare();
        });

        return $count;
    }

    public function getVotesByPoll(PollEntity $pollEntity): Collection
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('poll', $pollEntity));

        return $this->votes->matching($criteria);
    }

}
