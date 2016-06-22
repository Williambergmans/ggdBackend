<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use DB;

class themaController extends Controller
{
    // check if user is admin
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

         // function that returns an view thema data
     public function thema(){
         
         $themas = \App\themas::all();
         return view('themas', array('themas' => $themas));
     }
     
      // function that returns an view where you can edit theme data
     public function edit($id)
     {
         $row = DB::table('themainfo')->where('id',$id)->first();
         return view('editThema')->with('row', $row);
         
     }
     
   // post function for updating theme data
      public function update()
    {
         $id=Input::get('id');
         $titleName=Input::get('titleName');
         $infoName=Input::get('infoName');
         $photoName=Input::get('photoName');
         $emailName=Input::get('emailName');
         $phoneName=Input::get('phoneName');
         
    $data=array(
         'id'=>$id,
         'titel'=>$titleName,
         'info'=>$infoName,
         'photo'=>$photoName,
         'email'=>$emailName,
         'phone'=>$phoneName,
        );
    
        // send data to database
        $i = DB::table('themainfo')->where('id',$id)->update($data);
        // if data is send
             if($i > 0)
             {
                 // return to thema page
                 return redirect('themas');
                 
             }
        
        
        
  }
     
     
}
