<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use App\addInfo;



class addInformatieController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    
    public function addInformatie()
    {
      return view('toevoegeninformatie');
       
    }
    
    public function save()
    {
         $titleName=Input::get('titleName');
         $infoName=Input::get('infoName');
         $photoName=Input::get('photoName');
         $emailName=Input::get('emailName');
         $phoneName=Input::get('phoneName');
         
    $data=array(
         'titel'=>$titleName,
         'info'=>$infoName,
         'photo'=>$photoName,
         'email'=>$emailName,
         'phone'=>$phoneName,
        );
    
        $response=addInfo::create($data);
        if($response)
        {
            return redirect('informatie');
                 
        }
  }
}
