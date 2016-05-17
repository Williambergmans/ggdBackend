@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Voeg informatie toe</div>
                <div class="panel-body">
                   
                   <form action="" method="post"> 
            <input type="text" class="form-control" name="titleName" placeholder="Titel van calamiteit"><br>
            <input type="textarea" class="form-control"rows="5" name="infoName" placeholder="Informatie"><br>
               <select class="form-control" name ="categorieName">
                            <option value="InfectieZiekte">InfectieZiekte</option>
                            <option value="Hittegolf">Hittegolf</option>
                            <option value="Overige">Overige</option> 
                        </select><br>
             <input type="text" class="form-control" name="photoName" placeholder="Photo url"><br>
             <input type="text" class="form-control" name="emailName" placeholder="Email voor contact"><br>
               <input type="text" class="form-control" name="phoneName" placeholder="Nummer voor contact"><br>
            <input type="hidden" class="form-control" class="form-control" name="_token" value="{{ csrf_token() }}">
            <input type="submit"  class="btn btn-primary" value="Save">
        </form> 
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
        
     