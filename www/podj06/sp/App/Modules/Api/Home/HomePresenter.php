<?php
declare(strict_types=1);

namespace App\Modules\Api\Home;

use App\Domain\Service\Api\PublishExternalMeasurementService;
use App\Model\Database\EntityManager;
use App\Model\Exception\Logic\Api\PublishExternalMeasurementException;
use App\Model\Http\HttpMethod;
use App\Modules\Api\BaseApiPresenter;

class HomePresenter extends BaseApiPresenter
{
    public function __construct(
        private EntityManager $entityManager,
        private PublishExternalMeasurementService $publishExternalMeasurementService,
    )
    {
        parent::__construct();
    }

    public function renderDefault(): void
    {
        $this->sendJson(['up' => true]);
    }

    public function actionVerify(): void
    {
        $this->verifyMethod(HttpMethod::POST);

        $data = $this->getData();

        if (!isset($data['key']) || !isset($data['secret'])) {
            $this->sendJsonWithCode(['error' => 'missing data'], 400);
        }

        $apiCredentials = $this->entityManager->getApiCredentialsRepository()->findByKeyAndSecret($data['key'], $data['secret']);

        $this->sendJson(
            [
                'valid' => $apiCredentials !== null,
                'company' => $apiCredentials->getCompany(),
            ]
        );
    }

    /**
     * Example JSON DTO
     {
        "key": "eijznf2eez",
        "secret": "mjdk9h8o3v",
        "value": 2500.5,
        "type": "electricity",
        "unit": "kWh",
        "unitNumber": "44",
        "measuredAt": "2021-04-23T18:25:43.511Z",
        "sensorSn": "S/N:25565XCY"
    }
     */

    public function actionPublishMeasurement(): void
    {
        $this->verifyMethod(HttpMethod::POST);
        try {
            $this->publishExternalMeasurementService->publish($this->getData());
            $this->sendJson(['sucess' => true]);
        } catch (PublishExternalMeasurementException $e) {
            $this->sendJsonWithCode([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }

    }
}
