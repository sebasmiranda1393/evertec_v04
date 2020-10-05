<?php

namespace App\Services\Auth;

class AuthRequest
{

    /**
     * @var mixed|string
     */
    private $login;
    /**
     * @var Http\Controllers\Date|mixed
     */
    private $seed;
    /**
     * @var mixed|string
     */
    private $nonce;
    /**
     * @var mixed|string
     */
    private $tranKey;

    /**
     * @return mixed|string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed|string $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed|string
     */
    public function getTranKey()
    {
        return $this->tranKey;
    }

    /**
     * @param mixed|string $tranKey
     */
    public function setTranKey($tranKey): void
    {
        $secretKey = $tranKey;
        $this->tranKey = base64_encode(sha1($this->nonce . $this->seed . $secretKey, true));;
    }

    /**
     * @return mixed|string
     */
    public function getNonce()
    {
        return $this->nonce;
    }


    public function setNonce(): void
    {
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);

        $this->nonce = $nonceBase64;
    }

    /**
     * @return Http\Controllers\Date|mixed
     */
    public function getSeed()
    {
        return $this->seed;
    }

    /**
     * @param Http\Controllers\Date|mixed $seed
     */
    public function setSeed($seed): void
    {
        $this->seed = $seed;
    }


}
