<?php declare(strict_types = 1);

namespace App\UI\Form;

use Contributte\FormsBootstrap\BootstrapForm;
use Nette\Forms\Controls\TextInput;

class BaseForm extends BootstrapForm
{

	public function addFloat(string $name, ?string $label = null): TextInput
	{
		$input = self::addText($name, $label);
		$input->addCondition(self::FILLED)
			->addRule(self::MAX_LENGTH, null, 255)
			->addRule(self::FLOAT, 'Číslo není desetinné!');

		return $input;
	}

	public function addNumeric(string $name, ?string $label = null): TextInput
	{
		$input = self::addText($name, $label);
		$input->addCondition(self::FILLED)
			->addRule(self::MAX_LENGTH, null, 255)
			->addRule(self::NUMERIC, 'Vložená hodnota není číslo!');

		return $input;
	}

}
