<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appusers extends Model
{
     protected $table = 'appusers';
     protected $fillable = ['phoneid'];
     
     public static $rules = [
    'phoneid' => 'unique:appusers,phoneid'
];
 
     
   
}
