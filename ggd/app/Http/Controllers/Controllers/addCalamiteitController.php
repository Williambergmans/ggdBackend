<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\addCal;
use DB;

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
        
        function getDistance( $latitude1, $longitude1, $latitude2, $longitude2 ) {  
    $earth_radius = 6371;

    $dLat = deg2rad( $latitude2 - $latitude1 );  
    $dLon = deg2rad( $longitude2 - $longitude1 );  

    $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * sin($dLon/2) * sin($dLon/2);  
    $c = 2 * asin(sqrt($a));  
    $d = $earth_radius * $c;  

    return $d;  
}

        if($response)
        {
           $user = \App\appusers::all();
           $lat1 = DB::table('appusers')->select()->lists('userlat');
           $long1 = DB::table('appusers')->select()->lists('userlong');
              
   for ($i = 1; $i <=count($user); $i++) {

            $distance = getDistance( $lat1[0], $long1[0], $latitudeName, $longitudeName );
          
if( $distance < 25 ) {
      echo " 25 kilometer radius";
    
       $device_id = \App\appusers::where('distance', '=', 25000)->orWhere('distance', 15000)->orWhere('distance', 5000)->orWhere('distance', 1000)->get();
   
        $pushwoosh = new Pushwoosh();
    try {
      if (!$device_id->isEmpty()) { 
        
      $msg = $titleName;

      $pushwoosh->sendMessage($msg, $device_id->pluck('phoneid'));
        }
    } catch (Exception $ex) {
      // Doe iets met exception
        
        //echo $ex;
        console.log($ex);
    }

} else if( $distance < 15 )  {
    echo " 15 kilometer radius";
    
          $device_id = \App\appusers::where('distance', '=', 15000)->orWhere('distance', 5000)->orWhere('distance', 1000)->get();
    
    
        $pushwoosh = new Pushwoosh();
    try {
        if (!$device_id->isEmpty()) { 
        
      $msg = $titleName;

      $pushwoosh->sendMessage($msg, $device_id->pluck('phoneid'));
        }
    } catch (Exception $ex) {
      // Doe iets met exception
        
        //echo $ex;
        console.log($ex);
    }
} else if( $distance < 5 )  {
       echo " 5 kilometer radius";
      
    
    
        $device_id = \App\appusers::where('distance', '=', 5000)->orWhere('distance', 1000)->get();
    

        $pushwoosh = new Pushwoosh();
    try {
         if (!$device_id->isEmpty()) { 
        
      $msg = $titleName;

      $pushwoosh->sendMessage($msg, $device_id->pluck('phoneid'));
        }
    } catch (Exception $ex) {
      // Doe iets met exception
        
        //echo $ex;
        console.log($ex);
    }
}
else if( $distance < 1 )  {
      echo " 1 kilometer radius";
     
    
          $device_id = \App\appusers::where('distance', '=', 1000)->get();
    
        $pushwoosh = new Pushwoosh();
    try {
 
      if (!$device_id->isEmpty()) { 
      $msg = $titleName;

      $pushwoosh->sendMessage($msg, $device_id->pluck('phoneid'));
        }
dd($device_id);
    } catch (Exception $ex) {
      // Doe iets met exception
        
        //echo $ex;
        console.log($ex);
    }
}
            
        }
            //return redirect()->back();
           return redirect('calamiteiten');
       
        }
        
        

    }
    
}
