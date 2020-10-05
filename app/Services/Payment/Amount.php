<?php

namespace App\Services\Payment;


class Amount
{
    /**
     * @var mixed|string
     */
    private $currency;
    /**
     * @var mixed
     */
    private $total;

    /**
     * @return mixed|string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed|string $currency
     */
    public function setCurrency($currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }



}
