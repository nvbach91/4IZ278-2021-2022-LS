<?php
declare(strict_types=1);

namespace App\Model\Database\Repository;

use App\Model\Database\Entity\AnnouncementEntity;

/**
 * @method AnnouncementEntity|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method AnnouncementEntity|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method AnnouncementEntity[] findAll()
 * @method AnnouncementEntity[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<AnnouncementEntity>
 */
class AnnouncementRepository extends AbstractRepository
{
    /**
     * @returns AnnouncementEntity[]
     */
    public function findLatestWithLimitAndOffset(int $limit = 10, int $offset = 0): array
    {
        return $this->findBy([], ['createdAt' => 'DESC'], $limit, $offset);
    }
}
