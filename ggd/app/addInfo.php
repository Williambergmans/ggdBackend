<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class addInfo extends Model
{
     protected $table = 'informatie';
     protected $fillable = ['titel','info','photo','email','phone'];
}

