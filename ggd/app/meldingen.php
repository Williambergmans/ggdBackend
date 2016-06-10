<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meldingen extends Model
{
    protected $table = 'meldingen';
     protected $fillable = ['titel','datum','categorie', 'inhoud','latitude','longitude','mail','phone'];
}
