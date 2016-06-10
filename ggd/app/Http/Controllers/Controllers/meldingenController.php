<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

class meldingenController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    
     public function meldingen(){
         
         $meldingen = \App\meldingen::all();
         return view('meldingen', array('meldingen' => $meldingen));
     }
     
       public function delete($id)
     {
         $i = DB::table('meldingen')->where('id',$id)->delete();
         if ($i > 0 )
     {
         return redirect('meldingen');
     }         
     }
     
     
} 
