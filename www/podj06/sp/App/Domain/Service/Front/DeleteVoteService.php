<?php
declare(strict_types=1);

namespace App\Domain\Service\Front;

use App\Model\Database\Entity\UserVoteEntity;
use App\Model\Database\EntityManager;

class DeleteVoteService
{
    public function __construct(
        private EntityManager $entityManager,
    )
    {

    }

    public function delete(int $userId, int $pollId): void
    {
        $user = $this->entityManager->getUserRepository()->find($userId);
        $poll = $this->entityManager->getPollRepository()->find($pollId);

        if ($user === null || $poll === null || $poll->hasVotingEnded()) return;

        $toRemove = $user->getVotes()->filter(function(UserVoteEntity $entity) use ($pollId) {
            return $entity->getPoll()->getId() === $pollId;
        });

        foreach ($toRemove as $toBeRemoved) {
            $this->entityManager->remove($toBeRemoved);
        }

        $this->entityManager->flush();
    }
}
