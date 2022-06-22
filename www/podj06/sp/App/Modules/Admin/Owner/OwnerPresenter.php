<?php
declare(strict_types=1);

namespace App\Modules\Admin\Owner;

use App\Domain\Service\Admin\ResetUserPasswordService;
use App\Model\Database\Entity\UserEntity;
use App\Model\Database\EntityManager;
use App\Modules\Admin\BaseAdminPresenter;
use App\UI\Form\Admin\User\EditUserFormFactory;
use App\UI\Grid\Admin\OwnerGridBuilder;
use Nette\Application\UI\Form;
use Nette\ComponentModel\IComponent;

class OwnerPresenter extends BaseAdminPresenter
{
    private ?UserEntity $userEntity = null;

    public function __construct(
        private OwnerGridBuilder $ownerGridBuilder,
        private EntityManager $entityManager,
        private ResetUserPasswordService $resetUserPasswordService,
        private EditUserFormFactory $editUserFormFactory,
    )
    {
        parent::__construct();
    }


    public function createComponentOwnerGrid(): IComponent
    {
        return $this->ownerGridBuilder->create($this);
    }

    public function createComponentEditUserForm(): Form
    {
        return $this->editUserFormFactory->create($this->userEntity);
    }

    public function actionEdit(?int $id): void
    {
        $user = $id === null ? null : $this->entityManager->getUserRepository()->find($id);

        $this->userEntity = $user;
    }

    public function actionResetPassword(int $id): void
    {
        $user = $this->entityManager->getUserRepository()->find($id);

        if ($user === null) {
            $this->flashError(sprintf('Uživatel s id %s nenalezen', $id));
            $this->redirect(':Admin:Owner:');
        }

        $password = $this->resetUserPasswordService->reset($user);
        $this->flashSuccess(sprintf("Uživateli %s %s bylo vyresetováno heslo na <b>%s</b>", $user->getName(), $user->getSurname(), $password));
        $this->redirect(':Admin:Owner:');
    }
}
