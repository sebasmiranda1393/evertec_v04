<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthRequest extends Model
{

    /**
     * @var mixed|string
     */
    private $login;
    /**
     * @var mixed|string
     */
    private $tranKey;
    /**
     * @var mixed|string
     */
    private $nonce;
    /**
     * @var Http\Controllers\Date|mixed
     */
    private $seed;
}
