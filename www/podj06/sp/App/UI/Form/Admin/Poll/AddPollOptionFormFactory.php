<?php
declare(strict_types=1);

namespace App\UI\Form\Admin\Poll;

use App\Model\Database\Entity\PollEntity;
use App\Model\Database\Entity\PollOptionEntity;
use App\Model\Database\EntityManager;
use App\UI\Form\FormFactory;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Nette\Application\UI\Form;

class AddPollOptionFormFactory
{
    private PollEntity $pollEntity;

    public function __construct(
        private EntityManager $entityManager,
        private FormFactory $formFactory,
    )
    {

    }

    public function create(PollEntity $entity): Form
    {
        $this->pollEntity = $entity;

        $form = $this->formFactory->forBackend();
        $form->renderMode = RenderMode::INLINE;

        $form->addText('description', 'Popis volby')
            ->setPlaceholder('Popis volby')
            ->setRequired();
        $form->addSubmit('add', 'Přidat');

        $form->onSuccess[] = [$this, 'save'];

        return $form;
    }

    public function save(Form $form, $data): void
    {
        $optionEntity = new PollOptionEntity();
        $optionEntity->setPoll($this->pollEntity);
        $optionEntity->setDescription($data->description);

        $this->pollEntity->getOptions()->add($optionEntity);
        $this->entityManager->flush();
        $form->getPresenter()->redirect('this');
    }
}
