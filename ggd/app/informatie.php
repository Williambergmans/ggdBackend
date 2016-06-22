<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

  /**
   * model for showing info
   */

class informatie extends Model
{
    // Removes the 's' in the end from table name '
    protected $table = 'informatie';
    protected $fillable = ['titel','info','photo','email','phone'];
}
