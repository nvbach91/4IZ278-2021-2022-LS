<?php
declare(strict_types=1);

namespace App\UI\Form\Admin\HousingUnit;

use App\Model\Database\Entity\HousingUnitEntity;
use App\Model\Database\EntityManager;
use App\UI\Form\FormFactory;
use Nette\Application\UI\Form;

class EditHousingUnitFormFactory
{
    private ?HousingUnitEntity $housingUnitEntity = null;

    public function __construct(
        private FormFactory $formFactory,
        private EntityManager $entityManager,
    ) {

    }

    public function create(?HousingUnitEntity $entity): Form
    {
        $this->housingUnitEntity = $entity;
        $form = $this->formFactory->forBackend();

        $form->addText('number', 'Číslo bytu')
            ->setDefaultValue($entity?->getNumber())
            ->setRequired();

        $form->addInteger('floor', 'Poschodí')
            ->setDefaultValue($entity?->getFloor())
            ->setRequired();

        $form->addSelect('owner', 'Vlastník', $this->createOwnersSelect())
            ->setDefaultValue($entity?->getOwner()?->getId());

        $form->addFloat('area','Plocha (m²)')
            ->setDefaultValue($entity?->getArea())
            ->addRule($form::MIN, 'Neplatné číslo', 0)
            ->setHtmlAttribute('type', 'number')
            ->setHtmlAttribute('step', '0.01')
            ->setRequired();

        $form->addInteger('votesShare', 'Hlasovací podíl v domě')
            ->setDefaultValue($entity?->getVotesShare())
            ->addRule($form::MIN, 'Neplatné číslo', 0)
            ->setRequired();

        $form->addSubmit('send', 'Odeslat');


        $form->onSuccess[] = [$this, 'save'];

        return $form;
    }

    public function save(Form $form, $data): void
    {
        $entity = $this->housingUnitEntity;
        if ($entity === null) {
            $entity = new HousingUnitEntity();
        }

        $owner = empty($data->owner) ? null : $this->entityManager->getUserRepository()->find($data->owner);

        $entity->setNumber($data->number);
        $entity->setArea($data->area);
        $entity->setFloor($data->floor);
        $entity->setOwner($owner);
        $entity->setVotesShare($data->votesShare);

        if ($this->housingUnitEntity === null) {
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();
        $form->getPresenter()->flashMessage(
            sprintf(
                '%s jednotka číslo <b>%s</b>',
                $this->housingUnitEntity === null ? 'Vytvořena' : 'Aktualizována',
                $entity->getNumber()
            ),
            'success'
        );
        $form->getPresenter()->redirect(':Admin:HousingUnit:');
    }

    private function createOwnersSelect(): array
    {
        $values = [null => '---'];
        foreach ($this->entityManager->getUserRepository()->findAll() as $entity) {
            $values[$entity->getId()] = sprintf('%s %s', $entity->getName(), $entity->getSurname());
        }

        return $values;
    }
}
