<?php
declare(strict_types=1);

namespace App\UI\Form\Admin\Poll;

use App\Model\Database\Entity\PollEntity;
use App\Model\Database\EntityManager;
use App\UI\Form\FormFactory;
use Nette\Application\UI\Form;
use Nette\Security\User;

class EditBasicPollInfoFormFactory
{
    private ?PollEntity $pollEntity = null;

    private const DATETIME_FORMAT = 'Y-m-d\TH:i';

    public function __construct(
        private FormFactory $formFactory,
        private EntityManager $entityManager,
        private User $user,
    ) {

    }

    public function create(?PollEntity $entity): Form
    {
        $this->pollEntity = $entity;

        $form = $this->formFactory->forBackend();

        $form->addText('title', 'Název hlasování')
            ->setDefaultValue($entity?->getTitle())
            ->addRule($form::MAX_LENGTH, 'Titulek nesmí být delší než 255 znaků', 255)
            ->setRequired();

        $form->addTextArea('description', 'Popis hlasování', rows: 8)
            ->setDefaultValue($entity?->getDescription())
            ->setRequired();

        $form->addSelect('type', 'Typ odpovědi hlasování', $this->createTypeOptions())
            ->setDefaultValue($entity?->getType());

        $form->addDateTime('openedFrom', 'Otevřeno od')
            ->setFormat(self::DATETIME_FORMAT)
            ->setHtmlType('datetime-local')
            ->setDefaultValue($entity?->getOpenedFrom()->format(self::DATETIME_FORMAT))
            ->setRequired();

        $form->addDateTime('openedTo', 'Otevřeno do')
            ->setFormat(self::DATETIME_FORMAT)
            ->setHtmlType('datetime-local')
            ->setDefaultValue($entity?->getOpenedTo()->format(self::DATETIME_FORMAT))
            ->setRequired();

        $form->addSubmit('save', 'Uložit');

        $form->onSuccess[] = [$this, 'save'];

        return $form;
    }

    public function save(Form $form, $data): void
    {
        $entity = $this->pollEntity;

        if ($entity === null) {
            $entity = new PollEntity();
            $entity->setAuthor($this->entityManager->getUserRepository()->find($this->user->getId()));
        }

        $entity->setTitle($data->title);
        $entity->setType($data->type);
        $entity->setDescription($data->description);
        $entity->setOpenedFrom($data->openedFrom);
        $entity->setOpenedTo($data->openedTo);

        if ($entity->getType() === PollEntity::TYPE_FREETYPE) {
            $entity->getOptions()->clear();
        }

        if ($this->pollEntity === null) {
            $this->entityManager->persist($entity);
        }

        $this->entityManager->flush();
        $form->getPresenter()->flashMessage(
            sprintf(
                'Úspěšně %s hlasování',
                $this->pollEntity === null ? 'vytvořeno' : 'upraveno'
            ),
            'success'
        );
        $form->getPresenter()->redirect(':Admin:Poll:edit', $entity->getId());
    }

    private static function createTypeOptions(): array
    {
        return [
            PollEntity::TYPE_SELECT => 'Výběr jednoho',
            PollEntity::TYPE_MULTISELECT => 'Výběr více',
            PollEntity::TYPE_FREETYPE => 'Volná možnost',
        ];
    }
}
