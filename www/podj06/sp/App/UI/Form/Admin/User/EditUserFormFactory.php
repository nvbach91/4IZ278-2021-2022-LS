<?php
declare(strict_types=1);

namespace App\UI\Form\Admin\User;

use App\Model\Database\Entity\UserEntity;
use App\Model\Database\EntityManager;
use App\Model\Security\Passwords;
use App\UI\Form\FormFactory;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\SubmitButton;
use Nette\Utils\Random;

class EditUserFormFactory
{
    private ?UserEntity $userEntity = null;

    public function __construct(
        private FormFactory $formFactory,
        private EntityManager $entityManager,
    ) {

    }

    public function create(?UserEntity $entity): Form
    {
        $this->userEntity = $entity;
        $form = $this->formFactory->forBackend();

        $form->addText('name', 'Jméno')
            ->setDefaultValue($entity?->getName())
            ->addRule($form::MAX_LENGTH, 'Délka nesmí přesáhnout 255 znaků', 255)
            ->setRequired();

        $form->addText('surname', 'Příjmení')
            ->setDefaultValue($entity?->getSurname())
            ->addRule($form::MAX_LENGTH, 'Délka nesmí přesáhnout 255 znaků', 255)
            ->setRequired();

        $form->addEmail('email', 'Email')
            ->setDefaultValue($entity?->getEmail())
            ->addRule($form::MAX_LENGTH, 'Délka nesmí přesáhnout 255 znaků', 255)
            ->setPlaceholder('test@seznam.cz')
            ->setRequired();

        $form->addText('phone', 'Telefon')
            ->setDefaultValue($entity?->getPhone())
            ->addRule($form::MAX_LENGTH, 'Délka nesmí přesáhnout 255 znaků', 255)
            ->setPlaceholder('+420123456789')
            ->setRequired();

        $form->addSelect('role', 'Role', $this->createRoleSelect())
            ->setDefaultValue($entity?->getRole())
            ->setRequired();

        $form->addSubmit('save', 'Uložit');
        $form->addSubmit('cancel', 'Zpět')
            ->setBtnClass('btn-outline-danger');

        $form->onSuccess[] = [$this, 'save'];

        return $form;
    }

    public function save(Form $form, $data): void
    {
        /** @var SubmitButton $cancelBtn */
        if ($form['cancel']->isSubmittedBy()) {
            $form->getPresenter()->redirect(':Admin:Owner:');
        }

        $entity = $this->userEntity;

        $password = null;

        if ($entity === null) {
            $password = Random::generate();
            $entity = new UserEntity(
                $data->name,
                $data->surname,
                $data->email,
                $data->phone,
                Passwords::create()->hash($password),
            );
        } else {
            $entity->setName($data->name);
            $entity->setSurname($data->surname);
            $entity->setEmail($data->email);
            $entity->setPhone($data->phone);
        }

        $entity->setRole($data->role);

        if ($this->userEntity === null) {
            $this->entityManager->persist($entity);
            $form->getPresenter()->flashMessage(
                sprintf(
                    'Vytvořen uživatel s emailem <b>%s</b> a heslem <b>%s</b>',
                   $entity->getEmail(),
                    $password
                ),
                'success'
            );
        }

        $this->entityManager->flush();
        $form->getPresenter()->redirect(':Admin:Owner:');
    }

    private static function createRoleSelect(): array
    {
        return [
            UserEntity::ROLE_USER => 'Uživatel',
            UserEntity::ROLE_ADMIN => 'Administrátor',
        ];
    }

}
