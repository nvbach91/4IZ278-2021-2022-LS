<?php
declare(strict_types=1);

namespace App\Model\Database\Repository;
use App\Model\Database\Entity\ApiCredentialsEntity;

/**
 * @method ApiCredentialsEntity|NULL find($id, ?int $lockMode = NULL, ?int $lockVersion = NULL)
 * @method ApiCredentialsEntity|NULL findOneBy(array $criteria, array $orderBy = NULL)
 * @method ApiCredentialsEntity[] findAll()
 * @method ApiCredentialsEntity[] findBy(array $criteria, array $orderBy = NULL, ?int $limit = NULL, ?int $offset = NULL)
 * @extends AbstractRepository<ApiCredentialsEntity>
 */
class ApiCredentialsRepository extends AbstractRepository
{
    public function findByKeyAndSecret(string $key, string $secret): ?ApiCredentialsEntity
    {
        return $this->findOneBy(['key' => $key, 'secret' => $secret]);
    }
}
