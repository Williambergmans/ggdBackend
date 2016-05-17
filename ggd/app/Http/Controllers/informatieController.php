<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Input;
use DB;

class informatieController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    
     public function informatie(){
         
         $informatie = \App\informatie::all();
         return view('informatie', array('informatie' => $informatie));
     }
     
     public function delete($id)
     {
         $i = DB::table('informatie')->where('id',$id)->delete();
         if ($i > 0 )
     {
         return redirect('informatie');
     }         
     }
     
     public function edit($id)
     {
         $row = DB::table('informatie')->where('id',$id)->first();
         return view('editInformatie')->with('row', $row);
         
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
    
        $i = DB::table('informatie')->where('id',$id)->update($data);
             if($i > 0)
             {
                 return redirect('informatie');
                 
             }
        
        
        
  }
     
     
}
