@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Meldingen</div>
                <div class="list-group">
                    @foreach ($meldingen as $row)
                    <div class="list-group-item">
                        <div class="media col-md-3">
                            <figure class="pull-left">
                                <img class="media-object img-rounded img-responsive imagesize" style="width:100%; height:auto;" src="http://placehold.it/350x250" alt="placehold.it/350x250" >
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <h4 class="list-group-item-heading"> {{ $row->titel }} </h4>
                            <p>Datum: {{ $row->datum }}</p>
                            <p>Categorie: {{ $row->categorie }}</p>
                            <p>Inhoud: {{ $row->inhoud }}</p>
                            <p>Longitude: {{ $row->longitude }}  latitude: {{ $row->latitude }} </p>
                        </div>
                        <div class="col-md-3 ">
                            
                        
                            <div class="space">   
                                <span><a href="<?php echo 'DeleteMelding/' . $row->id ?>" class="btn btn-info" role="button">Verwijder</a></span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

