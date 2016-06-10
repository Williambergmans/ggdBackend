<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input; 
use DB;

class jsonController extends Controller
{
    

    
    public function calamiteiten(){
         
         $calamiteiten = \App\calamiteiten::orderBy('updated_at','desc' )->get();
       
         return view('calamiteitenJson', array('calamiteiten' => $calamiteiten));
  
     } 
     
 
       public function themas(){
         
         $themas = \App\themas::all();
         return view('themaJson', array('themas' => $themas));
     }
     
      public function informatie(){
         
         $informatie = \App\informatie::orderBy('titel','asc' )->get();
          // $calamiteiten = \App\calamiteiten::orderBy('updated_at','desc' )->get();
         return view('informatieJson', array('informatie' => $informatie));
     }
     
      public function save()
    { 

          $meldingen = new \App\meldingen;
          $meldingen->titel  = Input::get('titel', false);
          $meldingen->datum  = Input::get('datum', false);
          $meldingen->categorie  = Input::get('categorie', false);
          $meldingen->inhoud  = Input::get('inhoud', false);
          $meldingen->latitude  = Input::get('latitude', false);
          $meldingen->longitude  = Input::get('longitude', false);
          $meldingen->mail  = Input::get('mail', false);
          $meldingen->phone  = Input::get('phone', false);

    $data=array(
         'titel'=> $meldingen->titel, 
         'datum'=>$meldingen->datum,
        'categorie'=> $meldingen->categorie,
         'inhoud'=>$meldingen->inhoud,
        'latitude'=>$meldingen->latitude,
        'longitude'=>$meldingen->longitude,
        'mail'=>$meldingen->mail,
        'phone'=>$meldingen->phone,
        );
    
        $response=  \App\meldingen::create($data);
        if($response)
        {
           return response()->json(['Titel' => ' $meldingen->titel', 'datum' => '$meldingen->datum' , 'categorie' => ' $meldingen->categorie' , 'inhoud' => '$meldingen->inhoud' , 'latitude' => '$meldingen->latitude' , 'longitude' => '$meldingen->longitude']);
        }

    
    
  }
           public function saveVragenlijst()
    {
          
          $vragenlijst = new \App\vragenlijst;
          $vragenlijst->titel  = Input::get('titel', false);
          $vragenlijst->vraag1  = Input::get('vraag1', false);
          $vragenlijst->vraag2  = Input::get('vraag2', false);
          $vragenlijst->vraag3  = Input::get('vraag3', false);
          $vragenlijst->vraag4  = Input::get('vraag4', false);
          $vragenlijst->vraag5  = Input::get('vraag5', false);
          $vragenlijst->mail  = Input::get('mail', false);
          
        
    $data=array(
         'titel'=> $vragenlijst->titel,
         'vraag1'=>$vragenlijst->vraag1,
        'vraag2'=> $vragenlijst->vraag2,
         'vraag3'=>$vragenlijst->vraag3,
        'vraag4'=>$vragenlijst->vraag4,
        'vraag5'=>$vragenlijst->vraag5,
        'mail'=>$vragenlijst->mail,
        );
    
        $response= \App\vragenlijst::create($data);
        if($response)
        {
           return response()->json(['Titel' => ' $meldingen->titel', 'datum' => '$meldingen->datum' , 'categorie' => ' $meldingen->categorie' , 'inhoud' => '$meldingen->inhoud' , 'latitude' => '$meldingen->latitude' , 'longitude' => '$meldingen->longitude']);
        }

    
      //$meldingen = \App\meldingen::all();
        // return view('postMelding', array('meldingen' => $meldingen));
  }
  
            public function saveUserdata()
    {
                
                  $userdata = new \App\appusers();
                  $userdata->phoneid  = Input::get('phoneid', false);
  
                $user = \App\appusers::where('phoneid', '=',  $userdata->phoneid)->first();
if ($user === null) {
   // user doesn't exist

    $data=array(
         'phoneid'=> $userdata->phoneid,
         
        );
    
        $response= \App\appusers::create($data);
        if($response)
        {
           return response()->json(['phoneid' => '$userdata->phoneid']); 
        }
        

    
    
    
}
                
   
  }
         
      public function updateUserdata()
    {
         $userdata = new \App\appusers();
                  $userdata->phoneid  = Input::get('phoneid', false);
                  $userdata->userlat  = Input::get('userlat', false);
                  $userdata->userlong  = Input::get('userlong', false);
                  $userdata->distance  = Input::get('distance', false);
         
    $data=array(
         'userlat'=> $userdata->userlat,
         'userlong'=> $userdata->userlong,
         'distance'=> $userdata->distance,
        );
    
        $i = DB::table('appusers')->where('phoneid', $userdata->phoneid)->update($data);
             if($i > 0)
             {
                   return response()->json(['phoneid' => $userdata->phoneid]); 
                 
             }
  
    }
         

}