<?php
declare(strict_types=1);

namespace App\Modules\Front\Poll;

use App\Domain\Service\Front\DeleteVoteService;
use App\Domain\Service\Front\PreparePollResultsService;
use App\Model\Database\Entity\PollEntity;
use App\Model\Database\EntityManager;
use App\Modules\Front\BaseFrontPresenter;
use App\UI\Form\Front\Poll\VoteFormFactory;
use DateTime;
use Nette\Application\UI\Form;

class PollPresenter extends BaseFrontPresenter
{
    private PollEntity $pollEntity;

    public function __construct(
        private EntityManager $entityManager,
        private VoteFormFactory $voteFormFactory,
        private DeleteVoteService $deleteVoteService,
        private PreparePollResultsService $preparePollResultsService,
    )
    {
        parent::__construct();
    }

    public function actionVote(int $id): void
    {
        $poll = $this->entityManager->getPollRepository()->find($id);

        if ($poll === null) {
            $this->flashError(sprintf('Hlasování s ID %s nelze nalézt', $id));
            $this->redirect(':Front:Poll:');
        }

        if ($poll->hasUserVoted($this->getUser()->getId())) {
            $this->flashError('Už jste hlasovali!');
            $this->redirect(':Front:Poll:');
        }

        $this->pollEntity = $poll;
        $this->template->poll = $poll;
        $this->template->totalVoteShares = $this->entityManager->getHousingUnitRepository()->getTotalVoteShares();
        $this->template->userShares = $this->entityManager->getHousingUnitRepository()->getTotalVoteSharesByUser(
            $this->entityManager->getUserRepository()->find($this->getUser()->getId())
        );
    }

    public function handleDeleteVote(int $pollId): void
    {
        $this->deleteVoteService->delete($this->getUser()->getId(), $pollId);
        $this->redirect('this');
    }

    public function renderViewResults(int $id): void
    {
        $poll = $this->entityManager->getPollRepository()->find($id);

        if ($poll === null) {
            $this->flashError(sprintf('Hlasování s ID %s nelze nalézt', $id));
            $this->redirect(':Front:Poll:');
        }

        $this->template->poll = $poll;
        $this->template->result = $this->preparePollResultsService->createResult($poll);
        bdump($this->template->result);
    }

    public function renderDefault(): void
    {
        $this->template->currentDateTime = new DateTime();
        $this->template->polls = $this->entityManager->getPollRepository()->findLatestWithLimitAndOffset();
    }

    public function createComponentVoteForm(): Form
    {
        return $this->voteFormFactory->create($this->pollEntity);
    }
}
