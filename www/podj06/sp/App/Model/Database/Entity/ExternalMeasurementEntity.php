<?php
declare(strict_types=1);

namespace App\Model\Database\Entity;

use App\Model\Database\Entity\Attributes\TCreatedAt;
use App\Model\Database\Entity\Attributes\TId;
use App\Model\Exception\Logic\InvalidArgumentException;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Model\Database\Repository\ExternalMeasurementRepository")
 * @ORM\Table(name="external_measurement")
 * @ORM\HasLifecycleCallbacks
 */
class ExternalMeasurementEntity extends AbstractEntity
{
	public const TYPE_ELECTRICITY = 'electricity';
	public const TYPE_COLD_WATER = 'cold_water';
	public const TYPE_WARM_WATER = 'warm_water';
	public const TYPE_HEAT = 'heat';
	public const TYPE_GAS = 'gas';

	public const TYPES = [
		self::TYPE_ELECTRICITY,
		self::TYPE_COLD_WATER,
		self::TYPE_WARM_WATER,
		self::TYPE_HEAT,
		self::TYPE_GAS
	];

	use TId;
	use TCreatedAt;

	/**
	 * @ORM\Column(type="float")
	 */
	private float $value;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private string $unit;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private string $type;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private ?string $sensorSN;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private string $company;

	/**
	 * @ORM\Column(type="datetime")
	 */
	private DateTime $measuredAt;

	/**
	 * @ORM\ManyToOne(targetEntity="HousingUnitEntity", inversedBy="externalMeasurements")
	 * @ORM\JoinColumn(name="housing_unit_id", referencedColumnName="id", nullable=false)
	 */
	private HousingUnitEntity $housingUnit;

	public function setType(string $type): void
	{
		if (!in_array($type, self::TYPES)) {
			throw new InvalidArgumentException(sprintf('Unsupported type %s', $type));
		}

		$this->type = $type;
	}

    public function getType(): string
    {
        return $this->type;
    }

	/**
	 * @return float
	 */
	public function getValue(): float
	{
		return $this->value;
	}

	/**
	 * @param float $value
	 */
	public function setValue(float $value): void
	{
		$this->value = $value;
	}

	/**
	 * @return string
	 */
	public function getUnit(): string
	{
		return $this->unit;
	}

	/**
	 * @param string $unit
	 */
	public function setUnit(string $unit): void
	{
		$this->unit = $unit;
	}

	/**
	 * @return string|null
	 */
	public function getSensorSN(): ?string
	{
		return $this->sensorSN;
	}

	/**
	 * @param string|null $sensorSN
	 */
	public function setSensorSN(?string $sensorSN): void
	{
		$this->sensorSN = $sensorSN;
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

	/**
	 * @return DateTime
	 */
	public function getMeasuredAt(): DateTime
	{
		return $this->measuredAt;
	}

	/**
	 * @param DateTime $measuredAt
	 */
	public function setMeasuredAt(DateTime $measuredAt): void
	{
		$this->measuredAt = $measuredAt;
	}

	/**
	 * @return HousingUnitEntity
	 */
	public function getHousingUnit(): HousingUnitEntity
	{
		return $this->housingUnit;
	}

	/**
	 * @param HousingUnitEntity $housingUnit
	 */
	public function setHousingUnit(HousingUnitEntity $housingUnit): void
	{
		$this->housingUnit = $housingUnit;
	}

    public static function translateType(string $type): string
    {
        return match ($type) {
            self::TYPE_COLD_WATER => 'Voda',
            self::TYPE_WARM_WATER => 'Teplá voda',
            self::TYPE_HEAT => 'Teplo',
            self::TYPE_GAS => 'Plyn',
            self::TYPE_ELECTRICITY => 'Elektřina',
            default => 'Neznámý typ',
        };
    }
}
