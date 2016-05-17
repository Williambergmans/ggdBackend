@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Wijzig thema</div>
                <div class="panel-body">
                    <p style="color:red">{{ $errors->first('titel') }}</p>
                    <p style="color:red">{{ $errors->first('info') }}</p>
                    <p style="color:red">{{ $errors->first('photo') }}</p>
                    <p style="color:red">{{ $errors->first('email') }}</p>
                    <p style="color:red">{{ $errors->first('phone') }}</p>
                    

                   <form action="{{action('informatieController@update')}}" method="post"> 
                        <input type="hidden" name="id" value="<?= $row->id ?>">
            <input type="text" class="form-control" name="titleName" value="<?= $row->titel ?>"  placeholder="Titel van calamiteit"><br>
            <input type="textarea" class="form-control"rows="5" value="<?= $row->info ?>" name="infoName" placeholder="Informatie"><br>
             <input type="text" class="form-control" value="<?= $row->photo ?>" name="photoName" placeholder="Photo url"><br>
             <input type="text" class="form-control" value="<?= $row->email ?>" name="emailName" placeholder="Email voor contact"><br>
               <input type="text" class="form-control" value="<?= $row->phone ?>" name="phoneName" placeholder="Nummer voor contact"><br>
 
            <input type="hidden" class="form-control" class="form-control" name="_token" value="{{ csrf_token() }}">
           
            <input type="submit"  class="btn btn-primary" value="Sla op"> 
        </form> 
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
        
     