<?php

namespace App\Services\Response;
use App\Services\Status\Status;

class RedirectResponse
{
    /**
     * @var Status|mixed
     */
    private $status;
    /**
     * @var int|mixed
     */
    private $requestId;
    /**
     * @var false|mixed|string
     */
    private $processUrl;

    /**
     * @return Status|mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param Status|mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return int|mixed
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param int|mixed $requestId
     */
    public function setRequestId($requestId): void
    {
        $this->requestId = $requestId;
    }

    /**
     * @return false|mixed|string
     */
    public function getProcessUrl()
    {
        return $this->processUrl;
    }

    /**
     * @param false|mixed|string $processUrl
     */
    public function setProcessUrl($processUrl): void
    {
        $this->processUrl = $processUrl;
    }



}
