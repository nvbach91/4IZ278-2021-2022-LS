<?php
declare(strict_types=1);

namespace App\UI\Form\Front\Poll;

use App\Model\Database\Entity\PollEntity;
use App\Model\Database\Entity\PollOptionEntity;
use App\Model\Database\Entity\UserEntity;
use App\Model\Database\Entity\UserVoteEntity;
use App\Model\Database\EntityManager;
use App\UI\Form\FormFactory;
use Nette\Application\UI\Form;
use Nette\Security\User;

class VoteFormFactory
{
    private PollEntity $pollEntity;

    public function __construct(
        private FormFactory $formFactory,
        private EntityManager $entityManager,
        private User $user,
    )
    {

    }

    public function create(PollEntity $pollEntity): Form
    {
        $this->pollEntity = $pollEntity;
        $form = $this->formFactory->forBackend();

        if ($pollEntity->getType() === PollEntity::TYPE_SELECT) {
            $form->addSelect('vote', 'Volba', $this->createSelect());
        } elseif ($pollEntity->getType() === PollEntity::TYPE_MULTISELECT) {
            $form->addMultiSelect('vote', 'Volba', $this->createSelect());
        } else {
            $form->addText('vote', 'Volba');
        }

        $form->addTextArea('comment', 'Komentář');

        $form->addSubmit('send', 'Odeslat');

        $form->onSuccess[] = [$this, 'save'];

        return $form;
    }

    public function save(Form $form, $data): void
    {
        $pollEntity = $this->pollEntity;
        $user = $this->getUserEntity();
        $comment = empty($data->comment) ? null : $data->comment;

        if ($pollEntity->getType() === PollEntity::TYPE_SELECT) {
            $pollOption = $this->findPollOption($data->vote);
            $this->entityManager->persist(
                $this->createUserVoteEntity(
                    $user,
                    $pollOption,
                    $pollEntity,
                    null,
                    $comment,
                )
            );
        } elseif ($pollEntity->getType() === PollEntity::TYPE_MULTISELECT) {
            foreach ($data->vote as $optionId) {
                $pollOption = $this->findPollOption($optionId);
                $this->entityManager->persist(
                    $this->createUserVoteEntity(
                        $user,
                        $pollOption,
                        $pollEntity,
                        null,
                        $comment,
                    )
                );
            }
        } else { // In case of free text
            $this->entityManager->persist(
                $this->createUserVoteEntity(
                    $user,
                    null,
                    $pollEntity,
                    $data->vote,
                    $comment,
                )
            );
        }

        $this->entityManager->flush();
        $form->getPresenter()->flashMessage('Úspěšně odhlasování', 'success');
        $form->getPresenter()->redirect(':Front:Poll:');
    }

    private function createUserVoteEntity(
        UserEntity $user,
        ?PollOptionEntity $pollOption,
        PollEntity $pollEntity,
        ?string $freeText,
        ?string $comment
    ): UserVoteEntity
    {
        $entity = new UserVoteEntity();
        $entity->setUser($user);
        $entity->setPollOption($pollOption);
        $entity->setPoll($pollEntity);
        $entity->setFreeOptionText($freeText);
        $entity->setComment($comment);

        return $entity;
    }

    private function findPollOption(int $id): PollOptionEntity
    {
        return $this->entityManager->getPollOptionRepository()->find($id);
    }

    private function getUserEntity(): UserEntity
    {
        return $this->entityManager->getUserRepository()->find($this->user->getId());
    }

    private function createSelect(): array
    {
        $values = [];
        /** @var PollOptionEntity $option */
        foreach ($this->pollEntity->getOptions() as $option) {
            $values[$option->getId()] = $option->getDescription();
        }

        return $values;
    }
}
