<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class calamiteiten extends Model
{
   // Removes the 's' in the end from table name
   protected $table = 'calamiteiten';
   
  protected $dates = ['created_at', 'updated_at'];
 
}
  