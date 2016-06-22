<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


  /**
   * model for adding calamiteiten
   */
class addCal extends Model
{
     protected $table = 'calamiteiten';
     protected $fillable = ['calamiteitTitel','omschrijving','categorie','locatie','maand','dag', 'dagGetal', 'start','eind','email','phone','about','latitude','longitude','photo','vraag1Titel','vraag2Titel','vraag3Titel','vraag4Titel','vraag5Titel','template'];
}
