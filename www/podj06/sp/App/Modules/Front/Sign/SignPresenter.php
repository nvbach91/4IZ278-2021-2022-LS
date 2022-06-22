<?php declare(strict_types = 1);

namespace App\Modules\Front\Sign;

use App\Model\App;
use App\Model\Database\Entity\UserEntity;
use App\Model\Exception\Runtime\AuthenticationException;
use App\Modules\Front\BaseFrontUnsecuredPresenter;
use App\UI\Form\BaseForm;
use App\UI\Form\FormFactory;
use Nette\Application\UI\ComponentReflection;

final class SignPresenter extends BaseFrontUnsecuredPresenter
{

	/** @var string @persistent */
	public $backlink;

	/** @var FormFactory @inject */
	public $formFactory;

	/**
	 * @param ComponentReflection|mixed $element
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
	 */
	public function checkRequirements($element): void
	{
	}

	public function actionIn(): void
	{
		if ($this->user->isLoggedIn()) {
			$this->redirect(
                $this->user->isInRole(UserEntity::ROLE_ADMIN)
                    ? App::DESTINATION_ADMIN_HOMEPAGE
                    : App::DESTINATION_FRONT_HOMEPAGE
            );
		}
	}

	public function actionOut(): void
	{
		if ($this->user->isLoggedIn()) {
			$this->user->logout();
			$this->flashSuccess('Odhlášení proběhlo úspěšně');
		}

		$this->redirect(App::DESTINATION_FRONT_HOMEPAGE);
	}

	protected function createComponentLoginForm(): BaseForm
	{
		$form = $this->formFactory->forBackend();
		$form->addEmail('email')
			->setRequired(true);
		$form->addPassword('password')
			->setRequired(true);
		$form->addCheckbox('remember')
			->setDefaultValue(true);
		$form->addSubmit('submit');
		$form->onSuccess[] = [$this, 'processLoginForm'];

		return $form;
	}

	public function processLoginForm(BaseForm $form): void
	{
		try {
			$this->user->setExpiration($form->values->remember ? '14 days' : '20 minutes');
			$this->user->login($form->values->email, $form->values->password);
		} catch (AuthenticationException $e) {
			$form->addError('Neplatná kombinace uživatelského jména a hesla');

			return;
		}

        $this->redirect(
            $this->user->isInRole(UserEntity::ROLE_ADMIN)
                ? App::DESTINATION_ADMIN_HOMEPAGE
                : App::DESTINATION_FRONT_HOMEPAGE
        );
	}

}
