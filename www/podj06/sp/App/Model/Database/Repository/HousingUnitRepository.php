<?php
declare(strict_types=1);

namespace App\Model\Database\Repository;

use App\Model\Database\Entity\HousingUnitEntity;
use App\Model\Database\Entity\UserEntity;

/**
 * @method HousingUnitEntity|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method HousingUnitEntity|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method HousingUnitEntity[] findAll()
 * @method HousingUnitEntity[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<HousingUnitEntity>
 */
class HousingUnitRepository extends AbstractRepository
{
    public function findByNumber(string $number): ?HousingUnitEntity
    {
        return $this->findOneBy(['number' => $number]);
    }

    public function getTotalVoteShares(): int
    {
        return $this->createQueryBuilder('hu')
            ->select('SUM(hu.votesShare) as total')
            ->getQuery()
            ->getSingleScalarResult() ?? 0;
    }

    public function getTotalVoteSharesByUser(UserEntity $userEntity) {
        return $this->createQueryBuilder('hu')
            ->select('SUM(hu.votesShare) as total')
            ->leftJoin('hu.owner', 'owner')
            ->andWhere('owner = :user')
            ->setParameter('user', $userEntity)
            ->getQuery()
            ->getSingleScalarResult() ?? 0;
    }
}
