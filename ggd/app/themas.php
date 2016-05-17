<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class themas extends Model
{
      protected $table = 'themainfo';
     protected $fillable = ['titel','info','photo','email','phone'];
}
