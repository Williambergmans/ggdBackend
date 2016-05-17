<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class vragenlijst extends Model
{
    protected $table = 'vragenlijst';
     protected $fillable = ['titel' ,'vraag1','vraag2','vraag3', 'vraag4','vraag5'];
}
