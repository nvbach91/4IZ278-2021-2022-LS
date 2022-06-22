<?php
declare(strict_types=1);

namespace App\Model\Database\Repository;
use App\Model\Database\Entity\PollOptionEntity;

/**
 * @method PollOptionEntity|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method PollOptionEntity|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method PollOptionEntity[] findAll()
 * @method PollOptionEntity[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<PollOptionEntity>
 */
class PollOptionRepository extends AbstractRepository
{
}
