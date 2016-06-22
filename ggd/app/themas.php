<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


  /**
   * model for showing thema's
   */

class themas extends Model
{
      protected $table = 'themainfo';
     protected $fillable = ['titel','info','photo','email','phone'];
}
