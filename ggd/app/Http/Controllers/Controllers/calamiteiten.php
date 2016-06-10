<?php

namespace App;



use Illuminate\Database\Eloquent\Model;
use Carbon;

class calamiteiten extends Model
{
   // Removes the 's' in the end from table name
   protected $table = 'calamiteiten';
   
  protected $dates = ['created_at', 'updated_at'];
  
  
  
  /*
  public function getCreatedAtAttribute($date)
{
    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d H:i:s');
}

public function getUpdatedAtAttribute($date)
{
    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d H:i:s');
}
 */
}
  