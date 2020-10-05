<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedirectResponse extends Model
{
    public Status $status;
    public int $requestId;
    public String $processUrl;
}
