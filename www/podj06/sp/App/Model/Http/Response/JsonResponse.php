<?php
declare(strict_types=1);

namespace App\Model\Http\Response;

use Nette;

class JsonResponse implements \Nette\Application\Response
{
    /** @var mixed */
    private mixed $payload;

    /** @var string */
    private string $contentType;

    /** @var int */
    private int $code;

    public function __construct($payload, ?int $code = null, ?string $contentType = null)
    {
        $this->payload = $payload;
        $this->contentType = $contentType ?: 'application/json';
        $this->code = $code ?: 200;
    }


    /**
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }


    /**
     * Returns the MIME content type of a downloaded file.
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    /**
     * @inheritDoc
     */
    function send(Nette\Http\IRequest $httpRequest, Nette\Http\IResponse $httpResponse): void
    {
        $httpResponse->setCode($this->code);
        $httpResponse->setContentType($this->contentType, 'utf-8');
        echo Nette\Utils\Json::encode($this->payload);
    }
}
