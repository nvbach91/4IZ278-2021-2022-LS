<?php
declare(strict_types=1);

namespace App\UI\Form\Admin\HousingUnit;

use App\Domain\Service\Admin\ImportHousingUnitsService;
use App\Model\Exception\Logic\Admin\ImportHousingUnitsException;
use App\UI\Form\FormFactory;
use Nette\Application\UI\Form;
use Nette\Http\FileUpload;
use Nette\Utils\ArrayHash;

class ImportHousingUnitFormFactory
{
	public function __construct(
		private FormFactory $formFactory,
		private ImportHousingUnitsService $service,
	)
	{
	}

	public function create(): Form
	{
		$form = $this->formFactory->forBackend();

		$form->addUpload('file', 'Datový soubor')
			->setRequired();

		$form->addSubmit('send', 'Odeslat');

		$form->onSuccess[] = [$this, 'send'];

		return $form;
	}

	public function send(Form $form, ArrayHash $data): void
	{
		/** @var FileUpload $file */
		$file = $data->file;

		if ($file === null || !$file->isOk() || $file->getSize() === 0) {
			$form->addError('Soubor není validní');
			return;
		}

		try {
			$processed = $this->service->import($form, $file);
			$form->getPresenter()->flashMessage(sprintf('Import úspěšný. Vytvořeno <b>%s</b> záznamů', $processed));
			$form->getPresenter()->redirect(':Admin:HousingUnit:');
		} catch (ImportHousingUnitsException $e) {
			$form->addError($e->getMessage());
		}
	}
}
