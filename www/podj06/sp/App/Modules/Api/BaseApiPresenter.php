<?php
declare(strict_types=1);

namespace App\Modules\Api;

use App\Model\Http\Response\JsonResponse;
use Nette\Application\UI\Presenter;
use Nette\Http\Request;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

class BaseApiPresenter extends Presenter
{
    private Request $request;

    public function injectMain(Request $request) {
        $this->request = $request;
    }

    public function sendJsonWithCode(mixed $data, int $code): void
    {
        $this->sendResponse(new JsonResponse($data, $code));
    }

    public function verifyMethod(string $method): void
    {
        if ($this->getRequest()->getMethod() !== $method) {
            $this->sendJsonWithCode(['error' => 'wrong method!'], 405);
            exit();
        }
    }

    public function getData(): mixed
    {
        try {
            return Json::decode($this->request->getRawBody(), Json::FORCE_ARRAY);
        } catch (JsonException) {
            $this->sendJsonWithCode(['error' => 'invalid json!'], 400);
            exit();
        }
    }
}
