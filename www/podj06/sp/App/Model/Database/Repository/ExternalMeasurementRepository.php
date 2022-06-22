<?php
declare(strict_types=1);

namespace App\Model\Database\Repository;

use App\Model\Database\Entity\ExternalMeasurementEntity;

/**
 * @method ExternalMeasurementEntity|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method ExternalMeasurementEntity|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method ExternalMeasurementEntity[] findAll()
 * @method ExternalMeasurementEntity[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<ExternalMeasurementEntity>
 */
class ExternalMeasurementRepository extends AbstractRepository
{

}
