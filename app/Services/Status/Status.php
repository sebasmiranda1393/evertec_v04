<?php

namespace App\Services\Status;

use App\Services\Auth\AuthRequest;
use App\Services\Payment\PaymentRequest;

class Status
{
    /**
     * @var mixed|string
     */
    private $status;
    /**
     * @var mixed|string
     */
    private $reason;
    /**
     * @var mixed|string
     */
    private $message;
    /**
     * @return \DateTime|mixed
     */
    private $date;

    /**
     * @return mixed|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed|string $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed|string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param mixed|string $reason
     */
    public function setReason($reason): void
    {
        $this->reason = $reason;
    }

    /**
     * @return mixed|string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed|string $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }
}
