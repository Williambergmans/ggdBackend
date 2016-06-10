<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appusers extends Model
{
     protected $table = 'appusers';
     protected $fillable = ['phoneid','userlat','userlong','distance'];
     
     public static $rules = [
    'phoneid' => 'unique:appusers,phoneid'
];
 
     
   
}
 