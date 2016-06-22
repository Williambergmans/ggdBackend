<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

  /**
   * model for adding information
   */

class addInfo extends Model
{
     protected $table = 'informatie';
     protected $fillable = ['titel','info','photo','email','phone'];
}

