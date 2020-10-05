<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public String $name;
    public String $surname;
    public String $email;
    public String $document;
    public String $documentType;
    public int $mobile;

}
