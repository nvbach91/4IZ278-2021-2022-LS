<?php
declare(strict_types=1);

namespace App\Domain\Service\Front;

use App\Model\Database\Entity\PollEntity;
use App\Model\Database\Entity\UserEntity;
use App\Model\Database\Entity\UserVoteEntity;
use App\Model\Database\EntityManager;
use Doctrine\Common\Collections\Collection;

class PreparePollResultsService
{
    private array $resultMap = [];

    public function __construct(
        private EntityManager $entityManager,
    )
    {
    }

    public function createResult(PollEntity $pollEntity): array
    {
        $result = [];

        $totalShares = $this->entityManager->getHousingUnitRepository()->getTotalVoteShares();
        $voters = $this->entityManager->getUserRepository()->findThoseWhoVoted($pollEntity->getId());

        $result['totalShares'] = $totalShares;

        /** @var UserEntity $voter */
        foreach ($voters as $voter) {
            /** @var Collection<int, UserVoteEntity> $userVotes */
            $userVotes = $voter->getVotesByPoll($pollEntity);
            $userTotalVotes = $voter->getTotalVotes();
            $votes = [];

            if ($pollEntity->getType() === PollEntity::TYPE_FREETYPE) {
                $value = $userVotes[0]->getFreeOptionText();
                $votes[] = $value;
                $this->addToResultMap($value, $userTotalVotes);
            } elseif ($pollEntity->getType() === PollEntity::TYPE_SELECT) {
                $value = $userVotes[0]->getPollOption()->getDescription();
                $votes[] = $value;
                $this->addToResultMap($value, $userTotalVotes);
            } else {
                foreach ($userVotes as $userVote) {
                    $value = $userVote->getPollOption()->getDescription();
                    $votes[] = $value;
                    $this->addToResultMap($value, $userTotalVotes/$userVotes->count());
                }
            }

            $result['voters'][] = [
                'fullName' => $voter->getFullname(),
                'totalShares' => $userTotalVotes,
                'votes' => $votes
            ];
        }

        arsort($this->resultMap);

        if (count($this->resultMap) > 0) {
            $firstKey = reset($this->resultMap);
            $firstVal = key($this->resultMap);

            if ($firstKey/$totalShares > 0.5) {
                $result['result'] = [
                    'completed' => true,
                    'winner' => $firstVal,
                    'withNumberOfVotes' => $firstKey,
                ];
            } else {
                $result['result'] = [
                    'completed' => false,
                ];
            }
        } else {
            $result['result'] = [
                'completed' => false,
            ];
        }

        return $result;
    }

    private function addToResultMap(string $key, float $shares): void
    {
        if (isset($this->resultMap[$key])) {
            $this->resultMap[$key] += $shares;
        } else {
            $this->resultMap[$key] = $shares;
        }
    }
}
