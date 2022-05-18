<?php
declare(strict_types=1);

namespace App\Model\Database\Entity;

use App\Model\Database\Entity\Attributes\TCreatedAt;
use App\Model\Database\Entity\Attributes\TId;
use App\Model\Database\Entity\Attributes\TUpdatedAt;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\HousingUnitRepository")
 * @ORM\Table(name="housing_unit")
 * @ORM\HasLifecycleCallbacks
 */
class HousingUnitEntity extends AbstractEntity
{
	use TId;
	use TCreatedAt;
	use TUpdatedAt;

	/**
	 * @ORM\Column(type="float")
	 */
	private float $area;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private string $number;

	/**
	 * @ORM\Column(type="integer")
	 */
	private int $floor;

	/**
	 * @ORM\Column(type="integer")
	 */
	private int $votesShare;

	/**
	 * @ORM\ManyToOne(targetEntity="UserEntity", inversedBy="housingUnits")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	private UserEntity $owner;

	/**
	 * @var ArrayCollection<int, ExternalMeasurementEntity>
	 * @ORM\OneToMany(targetEntity="ExternalMeasurementEntity", mappedBy="housingUnit")
	 */
	private ArrayCollection $externalMeasurements;

	public function __construct()
	{
		$this->externalMeasurements = new ArrayCollection();
	}

	/**
	 * @return float
	 */
	public function getArea(): float
	{
		return $this->area;
	}

	/**
	 * @param float $area
	 */
	public function setArea(float $area): void
	{
		$this->area = $area;
	}

	/**
	 * @return string
	 */
	public function getNumber(): string
	{
		return $this->number;
	}

	/**
	 * @param string $number
	 */
	public function setNumber(string $number): void
	{
		$this->number = $number;
	}

	/**
	 * @return int
	 */
	public function getFloor(): int
	{
		return $this->floor;
	}

	/**
	 * @param int $floor
	 */
	public function setFloor(int $floor): void
	{
		$this->floor = $floor;
	}

	/**
	 * @return int
	 */
	public function getVotesShare(): int
	{
		return $this->votesShare;
	}

	/**
	 * @param int $votesShare
	 */
	public function setVotesShare(int $votesShare): void
	{
		$this->votesShare = $votesShare;
	}

	/**
	 * @return UserEntity
	 */
	public function getOwner(): UserEntity
	{
		return $this->owner;
	}

	/**
	 * @param UserEntity $owner
	 */
	public function setOwner(UserEntity $owner): void
	{
		$this->owner = $owner;
	}

	/**
	 * @return ArrayCollection<int, ExternalMeasurementEntity>
	 */
	public function getExternalMeasurements(): ArrayCollection
	{
		return $this->externalMeasurements;
	}

	public function addExternalMeasurement(ExternalMeasurementEntity $entity): void {
		$this->externalMeasurements->add($entity);
	}
}
