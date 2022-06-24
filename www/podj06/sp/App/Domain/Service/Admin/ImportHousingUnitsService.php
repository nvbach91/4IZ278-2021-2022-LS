<?php
declare(strict_types=1);

namespace App\Domain\Service\Admin;

use App\Model\Database\Entity\HousingUnitEntity;
use App\Model\Database\EntityManager;
use App\Model\Exception\Logic\Admin\ImportHousingUnitsException;
use Nette\Application\UI\Form;
use Nette\Http\FileUpload;

class ImportHousingUnitsService
{
	private const CSV_REQUIRED_COLS = 5;

	public function __construct(
		private string $uploadPath,
		private EntityManager $entityManager,
	)
	{
	}

	/**
	 * @throws ImportHousingUnitsException
	 */
	public function import(Form $form, FileUpload $file): int
	{
		$fileName = $this->moveFile($file);

		$csvArr = [];

		$file = @fopen($fileName, 'r');

		if ($file === false) {
			throw new ImportHousingUnitsException('Nešlo otevřít soubor pro čtení');
		}

		while (($data = fgetcsv($file, separator: ';')) !== false) {
			if (count($data) !== self::CSV_REQUIRED_COLS) continue;

			$csvArr[] = $data;
		}

		return $this->processData($form, $csvArr);
	}

	private function moveFile(FileUpload $fileUpload): string
	{
		$fileName = sprintf('%s/%s_%s', $this->uploadPath, md5(strval(time())), $fileUpload->getSanitizedName());
		$fileUpload->move($fileName);

		return $fileName;
	}

	/**
	 * @throws ImportHousingUnitsException
	 */
	private function processData(Form $form, array $csvArr): int
	{
		if (count($csvArr) < 2) {
			$form->addError('CSV file is empty!');
		}

		array_shift($csvArr); // Remove header

		$processed = 0;

		foreach ($csvArr as $index => $row) {
			$this->processRow($index, $row);
			$processed += 1;
		}

		return $processed;
	}

	/**
	 * @throws ImportHousingUnitsException
	 */
	private function processRow(int $index, array $row): void
	{
		$userId = is_numeric($row[0]) ? intval($row[0]) : null;
		if (!is_numeric($row[1])) {
			$this->throwInvalidColumnValue($index, 1);
		}
		$area = floatval($row[1]);

		if (strlen($row[2]) === 0) {
			$this->throwInvalidColumnValue($index, 2);
		}
		$unitNumber = $row[2];

		if (!is_numeric($row[3])) {
			$this->throwInvalidColumnValue($index, 3);
		}
		$floor = intval($row[3]);

		if (!is_numeric($row[4])) {
			$this->throwInvalidColumnValue($index, 4);
		}
		$voteShares = intval($row[4]);

		$this->createUnit($userId, $area, $unitNumber, $floor, $voteShares);
	}

	/**
	 * @throws ImportHousingUnitsException
	 */
	private function throwInvalidColumnValue(int $row, int $col): void
	{
		throw new ImportHousingUnitsException(sprintf('Chybná hodnota na řádku %s, sloupci %s', $row+1, $col));
	}

	/**
	 * @throws ImportHousingUnitsException
	 */
	private function createUnit(?int $userId, float $area, string $unitNumber, int $floor, int $voteShares): void
	{
		$user = $userId === null ? null : $this->entityManager->getUserRepository()->find($userId);
		$housingUnit = $this->entityManager->getHousingUnitRepository()->findByNumber($unitNumber);

		if ($housingUnit !== null) {
			throw new ImportHousingUnitsException(sprintf('Jedntka s číslem %s již existuje!', $unitNumber));
		}

		$housingUnit = new HousingUnitEntity();
		$housingUnit->setOwner($user);
		$housingUnit->setArea($area);
		$housingUnit->setNumber($unitNumber);
		$housingUnit->setFloor($floor);
		$housingUnit->setVotesShare($voteShares);

		$this->entityManager->persist($housingUnit);
		$this->entityManager->flush();
	}
}
