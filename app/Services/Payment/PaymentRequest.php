<?php

namespace App\Services\Payment;



class PaymentRequest
{
    /**
     * @var mixed|string
     */
    private $reference;
    /**
     * @var mixed|string
     */
    private $description;
    /**
     * @var Amount|mixed
     */
    private $amount;

    /**
     * @return mixed|string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed|string $reference
     */
    public function setReference($reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return mixed|string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed|string $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return Amount|mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param Amount|mixed $amount
     */
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }


}
