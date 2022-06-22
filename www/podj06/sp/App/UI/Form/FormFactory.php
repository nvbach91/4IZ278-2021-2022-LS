<?php declare(strict_types = 1);

namespace App\UI\Form;

use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\BootstrapVersion;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Contributte\FormsBootstrap\Inputs\DateTimeInput;

final class FormFactory
{

	private function create(): BaseForm
	{
        BootstrapForm::switchBootstrapVersion(BootstrapVersion::V5);
        DateTimeInput::$defaultFormat = "Y-m-d\TH:i";
        $form = new BaseForm();
		$form->renderMode = RenderMode::VERTICAL_MODE;

        return $form;
	}

	public function forFrontend(): BaseForm
	{
		return $this->create();
	}

	public function forBackend(): BaseForm
	{
		return $this->create();
	}

}
