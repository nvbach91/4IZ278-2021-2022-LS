<?php
declare(strict_types=1);

namespace App\Modules\Admin\Poll;

use App\Domain\Service\Admin\RemovePollOptionService;
use App\Model\Database\Entity\PollEntity;
use App\Model\Database\EntityManager;
use App\Model\Exception\Logic\RemovePollOptionException;
use App\Modules\Admin\BaseAdminPresenter;
use App\UI\Form\Admin\Poll\AddPollOptionFormFactory;
use App\UI\Form\Admin\Poll\EditBasicPollInfoFormFactory;
use App\UI\Grid\Admin\PollGridBuilder;
use Nette\Application\UI\Form;
use Ublaboo\DataGrid\DataGrid;

class PollPresenter extends BaseAdminPresenter
{
    private ?PollEntity $pollEntity = null;

    public function __construct(
        private EntityManager $entityManager,
        private PollGridBuilder $pollGridBuilder,
        private EditBasicPollInfoFormFactory $editBasicPollInfoFormFactory,
        private AddPollOptionFormFactory $addPollOptionFormFactory,
        private RemovePollOptionService $removePollOptionService,
    )
    {
        parent::__construct();
    }

    public function actionEdit(?int $id): void
    {
        $entity = $id === null ? null : $this->entityManager->getPollRepository()->find($id);
        $this->template->poll = $entity;
        $this->pollEntity = $entity;
    }

//    public function actionAddOption(int $id): void
//    {
//        $entity = $this->entityManager->getPollRepository()->find($id);
//
//        if ($entity === null) {
//            $this->flashError(sprintf('Hlasování s id %s neexistuje', $id));
//            $this->redirect(':Admin:Home:');
//        }
//    }

    public function handleDeleteOption(int $id, int $pollId): void
    {
        try {
            $this->removePollOptionService->remove($id);
        } catch (RemovePollOptionException $e) {
            $this->flashError($e->getMessage());
        }

        $this->redirect(':Admin:Poll:edit', $pollId);
    }

    public function createComponentEditBasicPollInfoForm(): Form
    {
        return $this->editBasicPollInfoFormFactory->create($this->pollEntity);
    }

    public function createComponentPollGrid(): DataGrid
    {
        return $this->pollGridBuilder->create($this);
    }

    public function createComponentAddPollOptionForm(): Form
    {
        return $this->addPollOptionFormFactory->create($this->pollEntity);
    }
}
