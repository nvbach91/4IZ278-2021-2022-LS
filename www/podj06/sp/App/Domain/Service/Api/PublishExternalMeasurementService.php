<?php
declare(strict_types=1);

namespace App\Domain\Service\Api;

use App\Model\Database\Entity\ExternalMeasurementEntity;
use App\Model\Database\EntityManager;
use App\Model\Exception\Logic\Api\PublishExternalMeasurementException;
use App\Model\Utils\DateTime;
use Exception;

class PublishExternalMeasurementService
{
    private const REQUIRED_ARGUMENTS = ['key', 'secret', 'value', 'unit', 'measuredAt', 'unitNumber'];
    private const OPTIONAL_ARGUMENTS = ['sensorSn'];

    public function __construct(
        private EntityManager $entityManager
    )
    {
    }

    /**
     * @throws PublishExternalMeasurementException
     */
    public function publish(array $data): void
    {
        foreach (self::REQUIRED_ARGUMENTS as $requiredArgument) {
            if (!isset($data[$requiredArgument])) {
                throw new PublishExternalMeasurementException(sprintf("Parameter %s is missing!", $requiredArgument));
            }
        }

        $apiCredentialsEntity = $this->entityManager->getApiCredentialsRepository()->findByKeyAndSecret(
            $data['key'],
            $data['secret']
        );

        if ($apiCredentialsEntity === null) {
            throw new PublishExternalMeasurementException("Invalid key and secret combination provided!");
        }

        if (!in_array($data['type'], ExternalMeasurementEntity::TYPES)) {
            throw new PublishExternalMeasurementException(
                sprintf(
                    "Invalid type! Possible values: %s",
                    implode(', ', ExternalMeasurementEntity::TYPES)
                )
            );
        }

        $value = $data['value'];
        if (!is_integer($value) && !is_float($value)) {
            throw new PublishExternalMeasurementException("Attribute value must be numeric!");
        }

        $date = null;

        try {
            $date = DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $data['measuredAt']);
        } catch (Exception) {
            throw new PublishExternalMeasurementException("Invalid datetime format, please use ISO8601");
        }

        $housingUnitEntity = $this->entityManager->getHousingUnitRepository()->findByNumber($data['unitNumber']);

        if ($housingUnitEntity === null) {
            throw new PublishExternalMeasurementException("Could not find correct housing unit!");
        }

        $externalMeasurement = new ExternalMeasurementEntity();
        $externalMeasurement->setCompany($apiCredentialsEntity->getCompany());
        $externalMeasurement->setValue(floatval($value));
        $externalMeasurement->setMeasuredAt($date);
        $externalMeasurement->setUnit($data['unit']);
        $externalMeasurement->setSensorSN($data['sensorSn'] ?? null);
        $externalMeasurement->setType($data['type']);
        $externalMeasurement->setHousingUnit($housingUnitEntity);

        $housingUnitEntity->getExternalMeasurements()->add($externalMeasurement);
        $this->entityManager->flush();
    }
}
