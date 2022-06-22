<?php
declare(strict_types=1);

namespace App\Modules\Admin\HousingUnit;

use App\Model\Database\Entity\HousingUnitEntity;
use App\Model\Database\EntityManager;
use App\Modules\Admin\BaseAdminPresenter;
use App\UI\Form\Admin\HousingUnit\EditHousingUnitFormFactory;
use App\UI\Grid\Admin\HousingUnitGridBuilder;
use Nette\ComponentModel\IComponent;

class HousingUnitPresenter extends BaseAdminPresenter
{
    private ?HousingUnitEntity $housingUnitEntity = null;

    public function __construct(
        private EntityManager $entityManager,
        private EditHousingUnitFormFactory $editHousingUnitFormFactory,
        private HousingUnitGridBuilder $housingUnitGridBuilder,
    )
    {
        parent::__construct();
    }

    public function actionEdit(?int $id): void
    {
        $housingUnit = $id === null ? null : $this->entityManager->getHousingUnitRepository()->find($id);

        $this->housingUnitEntity = $housingUnit;
    }

    public function actionDelete(int $id): void
    {
        $entity = $this->entityManager->getHousingUnitRepository()->find($id);

        if ($entity === null) {
            $this->flashError(sprintf('Jednotka s ID %s neexistuje', $id));
            $this->redirect(':Admin:HousingUnit:');
        }

        $this->entityManager->remove($entity);
        $this->entityManager->flush();
        $this->flashSuccess('Jednotka smazána');
        $this->redirect(':Admin:HousingUnit:');
    }

    public function createComponentEditHousingUnitForm(): IComponent
    {
        return $this->editHousingUnitFormFactory->create($this->housingUnitEntity);
    }

    public function createComponentHousingUnitGrid(): IComponent
    {
        return $this->housingUnitGridBuilder->build($this);
    }


}
