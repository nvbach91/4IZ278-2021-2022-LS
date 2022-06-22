<?php
declare(strict_types=1);

namespace App\UI\Form\Admin\ApiCredentials;

use App\Model\Database\Entity\ApiCredentialsEntity;
use App\Model\Database\EntityManager;
use App\UI\Form\FormFactory;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\SubmitButton;

class CreateApiCredentialsFormFactory
{
    public function __construct(
        private FormFactory $formFactory,
        private EntityManager $entityManager,
    ) {
    }

    public function create(): Form
    {
        $form = $this->formFactory->forBackend();

        $form->addText('company', 'Firma')
            ->addRule($form::MAX_LENGTH, 'Délka nesmí přesáhnout 255 znaků!', 255)
            ->setPlaceholder('Pražská bombová s.r.o')
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
            $form->getPresenter()->redirect(':Admin:ApiCredentials:');
        }

        $entity = ApiCredentialsEntity::create($data->company);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $form->getPresenter()->flashMessage('API klíč úspěšně vytvořen', 'success');
        $form->getPresenter()->redirect(':Admin:ApiCredentials:');
    }
}
