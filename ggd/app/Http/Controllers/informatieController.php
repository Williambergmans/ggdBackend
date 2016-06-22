<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use DB;

class informatieController extends Controller
{
      // check if user is admin
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

     // function that returns an view
     public function informatie(){
         
         $informatie = \App\informatie::all();
         return view('informatie', array('informatie' => $informatie));
     }
     
     // function that deletes information
     public function delete($id)
     {
         $i = DB::table('informatie')->where('id',$id)->delete();
         if ($i > 0 )
     {
         return redirect('informatie');
     }         
     }
     
     // show edit information page by id
     public function edit($id)
     {
         $row = DB::table('informatie')->where('id',$id)->first();
         return view('editInformatie')->with('row', $row);
         
     }
     // save new information
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
          // save data to database
        $i = DB::table('informatie')->where('id',$id)->update($data);
        //if data is saved
             if($i > 0)
             {   
                 // return to information page
                 return redirect('informatie');
                 
             }
        
        
        
  }
     
     
}
