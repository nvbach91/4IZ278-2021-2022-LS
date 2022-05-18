<?php
declare(strict_types=1);

namespace App\Model\Database\Repository;

use App\Model\Database\Entity\HousingUnitEntity;

/**
 * @method HousingUnitEntity|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method HousingUnitEntity|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method HousingUnitEntity[] findAll()
 * @method HousingUnitEntity[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<HousingUnitEntity>
 */
class HousingUnitRepository extends AbstractRepository
{

}
