<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedirectRequest extends Model
{
    /**
     * @var PaymentRequest|mixed
     */
    private $payment;
    /**
     * @var AuthRequest|mixed
     */
    private $auth;
    /**
     * @var false|mixed|string
     */
    private $expiration;
    /**
     * @var mixed|string
     */
    private $returnUrl;
    /**
     * @var mixed|string
     */
    private $ipAddress;
    /**
     * @var mixed|string
     */
    private $userAgent;

}
