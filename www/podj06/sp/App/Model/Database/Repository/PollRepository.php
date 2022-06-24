<?php
declare(strict_types=1);

namespace App\Model\Database\Repository;

use App\Model\Database\Entity\PollEntity;

/**
 * @method PollEntity|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method PollEntity|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method PollEntity[] findAll()
 * @method PollEntity[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<PollEntity>
 */
class PollRepository extends AbstractRepository
{
    /**
     * @returns PollEntity[]
     */
    public function findLatestWithLimitAndOffset(int $limit = 10, int $offset = 0): array
    {
        return $this->findBy([], ['openedTo' => 'DESC'], $limit, $offset);
    }
}
