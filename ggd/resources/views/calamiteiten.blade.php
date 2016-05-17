@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Calamiteiten
                    <a class="pull-right" href="<?php echo 'toevoegencalamiteit' ?>">Voeg calamiteit toe</a>
                </div>
                <div class="list-group">
                    @foreach ($calamiteiten as $row)

                    <div class="list-group-item">
                        <div class="media col-md-3">
                            <figure class="pull-left">
                                <img class="media-object img-rounded img-responsive imagesize" style="width:100%; height:auto;" src="{{ $row->photo }}" alt="placehold.it/350x250" >
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <h4 class="list-group-item-heading"> {{ $row->calamiteitTitel }} </h4>
                            <p class="list-group-item-text">{{ $row->omschrijving }}
                            </p>
                        </div>
                        <div class="col-md-3 ">
                            <h4 class="list-group-item-heading">{{ $row->dagGetal }}  {{ $row->maand }} </h4>
                            <div class="space">   
                                <p>Van: {{ $row->start }} t/m {{ $row->eind }}  </p>
                            </div>
                            <div class="space">        
                                <span class="fa fa-map-marker" aria-hidden="true"></span> 
                                <span>{{ $row->locatie }} </span>
                            </div>
                            <div class="space">   
                                <span><a href="<?php echo 'EditCalamiteit/' . $row->id ?>" class="btn btn-info" role="button">Pas aan</a></span>
                                <span><a href="<?php echo 'DeleteCalamiteit/' . $row->id ?>" class="btn btn-info" role="button">Verwijder</a></span>
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

