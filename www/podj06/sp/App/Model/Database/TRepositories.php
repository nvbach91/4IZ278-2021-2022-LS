<?php declare(strict_types = 1);

namespace App\Model\Database;

use App\Model\Database\Entity\AnnouncementEntity;
use App\Model\Database\Entity\ApiCredentialsEntity;
use App\Model\Database\Entity\ExternalMeasurementEntity;
use App\Model\Database\Entity\HousingUnitEntity;
use App\Model\Database\Entity\PollEntity;
use App\Model\Database\Entity\PollOptionEntity;
use App\Model\Database\Entity\UserEntity;
use App\Model\Database\Repository\AnnouncementRepository;
use App\Model\Database\Repository\ApiCredentialsRepository;
use App\Model\Database\Repository\ExternalMeasurementRepository;
use App\Model\Database\Repository\HousingUnitRepository;
use App\Model\Database\Repository\PollOptionRepository;
use App\Model\Database\Repository\PollRepository;
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

    public function getPollRepository(): PollRepository
    {
        return $this->getRepository(PollEntity::class);
    }

    public function getPollOptionRepository(): PollOptionRepository
    {
        return $this->getRepository(PollOptionEntity::class);
    }

    public function getHousingUnitRepository(): HousingUnitRepository
    {
        return $this->getRepository(HousingUnitEntity::class);
    }

    public function getExternalMeasurementRepository(): ExternalMeasurementRepository
    {
        return $this->getRepository(ExternalMeasurementEntity::class);
    }

    public function getApiCredentialsRepository(): ApiCredentialsRepository
    {
        return $this->getRepository(ApiCredentialsEntity::class);
    }

    public function getAnnouncementRepository(): AnnouncementRepository
    {
        return $this->getRepository(AnnouncementEntity::class);
    }

}
