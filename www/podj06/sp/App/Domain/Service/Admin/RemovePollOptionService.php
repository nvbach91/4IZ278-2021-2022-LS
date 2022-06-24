<?php
declare(strict_types=1);

namespace App\Domain\Service\Admin;

use App\Model\Database\EntityManager;
use App\Model\Exception\Logic\RemovePollOptionException;

class RemovePollOptionService
{
    public function __construct(
        private EntityManager $entityManager,
    )
    {
    }

    /**
     * @throws RemovePollOptionException
     */
    public function remove(int $id): void
    {
        $entity = $this->entityManager->getPollOptionRepository()->find($id);

        if ($entity === null) {
            throw new RemovePollOptionException(sprintf("Volba s ID %s neexistuje", $id));
        }

        $entity->getPoll()->getOptions()->removeElement($entity);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();
    }
}
