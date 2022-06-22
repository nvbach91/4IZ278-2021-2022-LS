<?php
declare(strict_types=1);

namespace App\UI\Form\Admin\Announcement;

use App\Model\Database\Entity\AnnouncementEntity;
use App\Model\Database\EntityManager;
use App\UI\Form\FormFactory;
use Nette\Application\UI\Form;
use Nette\Security\User;

class EditAnnouncementFormFactory
{
    private ?AnnouncementEntity $announcementEntity;

    public function __construct(
        private FormFactory $formFactory,
        private EntityManager $entityManager,
        private User $user,
    ) {
    }

    public function create(?AnnouncementEntity $entity): Form
    {
        $this->announcementEntity = $entity;

        $form = $this->formFactory->forBackend();

        $form->addText('title', 'Titulek')
            ->setDefaultValue($entity?->getTitle());
        $form->addTextArea('content', 'Obsah', rows: 15)
            ->setDefaultValue($entity?->getContent());

        $form->addSubmit('send', 'Uložit');
        $form->addSubmit('cancel', 'Zpět')
            ->setBtnClass('btn-outline-danger');

        $form->onSuccess[] = [$this, 'save'];

        return $form;
    }

    public function save(Form $form, $data): void
    {
        $entity = $this->announcementEntity;

        if ($this->announcementEntity === null) {
            $entity = new AnnouncementEntity();
        }

        $entity->setTitle($data->title);
        $entity->setContent($data->title);

        $user = $this->entityManager->getUserRepository()->find($this->user->getId());
        $entity->setUser($user);
        $user->getAnnouncements()->add($entity);

        $this->entityManager->flush();
        $form->getPresenter()->flashMessage('Oznámení úspěšně vytvořeno', 'success');
        $form->getPresenter()->redirect(':Admin:Announcement:');
    }
}
