<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use DB;

class themaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    
     public function thema(){
         
         $themas = \App\themas::all();
         return view('themas', array('themas' => $themas));
     }
     
     
     public function edit($id)
     {
         $row = DB::table('themainfo')->where('id',$id)->first();
         return view('editThema')->with('row', $row);
         
     }
     
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
    
        $i = DB::table('themainfo')->where('id',$id)->update($data);
             if($i > 0)
             {
                 return redirect('themas');
                 
             }
        
        
        
  }
     
     
}
