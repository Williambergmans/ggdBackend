<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\addCal;

Use App\Libraries\Pushwoosh;

class addCalamiteitController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

  
    public function addCalamiteit()
    {
      return view('toevoegencalamiteit');
  
    }
    
    public function save()
    {
         $titleName=Input::get('titleName');
         $omschrijvingName=Input::get('omschrijvingName');
         $categorieName=Input::get('categorieName');
         $locatieName=Input::get('locatieName');
         $maandName=Input::get('maandName');
         $dagName=Input::get('dagName');
         $dagGetalName=Input::get('dagGetalName');
         $startName=Input::get('startName');
         $eindName=Input::get('eindName');
         $emailName=Input::get('emailName');
         $phoneName=Input::get('phoneName');
         $inhoudName=Input::get('inhoudName');
         $latitudeName=Input::get('latitudeName');
         $longitudeName=Input::get('longitudeName');
         $photoName=Input::get('photoName');
         $vraag1Name=Input::get('vraag1Name');
         $vraag2Name=Input::get('vraag2Name');
         $vraag3Name=Input::get('vraag3Name');
         $vraag4Name=Input::get('vraag4Name');
         $vraag5Name=Input::get('vraag5Name');
         $templateName=Input::get('templateName');
    $data=array(
         'calamiteitTitel'=>$titleName,
         'omschrijving'=>$omschrijvingName,
         'categorie'=>$categorieName,
         'locatie'=>$locatieName,
         'maand'=>$maandName,
         'dag'=>$dagName,
         'dagGetal'=>$dagGetalName,
         'start'=>$startName,
         'eind'=>$eindName,
         'email'=>$emailName,
         'phone'=>$phoneName,
         'about'=>$inhoudName,
         'latitude'=>$latitudeName,
         'longitude'=>$longitudeName,
         'photo'=>$photoName,
         'vraag1Titel'=>$vraag1Name,
         'vraag2Titel'=>$vraag2Name,
         'vraag3Titel'=>$vraag3Name,
         'vraag4Titel'=>$vraag4Name,
         'vraag5Titel'=>$vraag5Name,
         'templates'=>$templateName,
           
        );
        $response=addCal::create($data);
        if($response)
        {
           
            //ios //$device_id = "AD176F1E-AE7C-49DA-B78F-27B8E187D5A8";
            //android
           
                  $device_id = \App\appusers::all();
            
             
   
        $pushwoosh = new Pushwoosh();
    try {
      $msg = $titleName ;
      $pushwoosh->sendMessage($msg, $device_id->pluck('phoneid'));
    } catch (Exception $ex) {
      // Doe iets met exception
        
        //echo $ex;
        console.log($ex);
    }
            return redirect()->back();
       
        }

    }
    
}
