<?php

namespace App\Services\Request;

use App\Services\Auth\AuthRequest;
use App\Services\Payment\PaymentRequest;

class RedirectRequest
{
    /**
     * @var AuthRequest|mixed
     */
    private $auth;
    /**
     * @var PaymentRequest|mixed
     */
    private $payment;
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

    /**
     * @return AuthRequest|mixed
     */
    public function getAuth()
    {
        return $this->auth;
    }

    /**
     * @param AuthRequest|mixed $auth
     */
    public function setAuth($auth): void
    {
        $this->auth = $auth;
    }

    /**
     * @return PaymentRequest|mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param PaymentRequest|mixed $payment
     */
    public function setPayment($payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return false|mixed|string
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * @param false|mixed|string $expiration
     */
    public function setExpiration($expiration): void
    {
        $this->expiration = $expiration;
    }

    /**
     * @return mixed|string
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * @param mixed|string $returnUrl
     */
    public function setReturnUrl($returnUrl): void
    {
        $this->returnUrl = $returnUrl;
    }

    /**
     * @return mixed|string
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param mixed|string $ipAddress
     */
    public function setIpAddress($ipAddress): void
    {
        $this->ipAddress = $ipAddress;
    }

    /**
     * @return mixed|string
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param mixed|string $userAgent
     */
    public function setUserAgent($userAgent): void
    {
        $this->userAgent = $userAgent;
    }



}
