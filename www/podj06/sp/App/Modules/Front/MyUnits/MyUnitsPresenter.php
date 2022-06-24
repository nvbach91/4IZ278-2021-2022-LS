<?php
declare(strict_types=1);

namespace App\Modules\Front\MyUnits;

use App\Model\Database\EntityManager;
use App\Modules\Front\BaseFrontPresenter;

class MyUnitsPresenter extends BaseFrontPresenter
{
    public function __construct(
        private EntityManager $entityManager,
    ) {
    }

    public function renderDefault(): void
    {
        $this->template->myUnits = $this->entityManager->getHousingUnitRepository()->findBy(['owner' => $this->user->getId()]);
    }

    public function renderDetail(int $id): void
    {
        $unit = $this->entityManager->getHousingUnitRepository()->find($id);

        if ($unit === null) {
            $this->flashError(sprintf('Jednotka s ID %s neexistuje', $id));
            $this->redirect(':Front:MyUnits:');
        }

        if ($unit?->getOwner()?->getId() !== $this->getUser()->getId()) {
            $this->flashError(sprintf('Nejste majitelem jednotky s ID %s!', $id));
            $this->redirect(':Front:MyUnits:');
        }

        $this->template->unit = $unit;
        $this->template->totalVoteShares = $this->entityManager->getHousingUnitRepository()->getTotalVoteShares();
    }
}
