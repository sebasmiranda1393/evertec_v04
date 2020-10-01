<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class PaymentRequest extends Model
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
}
