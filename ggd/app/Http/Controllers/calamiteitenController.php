<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use DB;


class calamiteitenController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    
    public function delete($id)
     {
         $i = DB::table('calamiteiten')->where('id',$id)->delete();
         if ($i > 0 )
     {
         return redirect('calamiteiten');
     }         
     }
     
     public function edit($id)
     {
         $row = DB::table('calamiteiten')->where('id',$id)->first();
         return view('editCalamiteit')->with('row', $row);
         
     }
     
     public function updateCal()
    {
         $id=Input::get('id');
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
         'id'=>$id,
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
         'template'=>$templateName,
           
        );
    
     $i = DB::table('calamiteiten')->where('id',$id)->update($data);
             if($i > 0)
             {
                 return redirect('calamiteiten');
                 
             }
    
  }
    
     public function calamiteiten(){
         
         $calamiteiten = \App\calamiteiten::all();
         return view('calamiteiten', array('calamiteiten' => $calamiteiten));
        // return View::make('calamiteiten')->with('calamiteit_list',  calamiteiten::all());
     }
    
     
    
  
    
}
