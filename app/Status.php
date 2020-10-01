<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public string $status;
    public string $reason;
    public string$message;
    public Date $date;
}
