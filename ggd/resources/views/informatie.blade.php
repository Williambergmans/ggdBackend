@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Thema's
                    <a class="pull-right" href="<?php echo 'toevoegeninformatie' ?>">Voeg informatie toe</a>
                </div>
                <div class="list-group">
                    @foreach ($informatie as $row)
                    <div class="list-group-item">
                        <div class="media col-md-3">
                            <figure class="pull-left">
                                <img class="media-object img-rounded img-responsive imagesize" style="width:100%; height:auto;" src="{{ $row->photo }}" alt="placehold.it/350x250">
                            </figure>
                        </div>
                        <div class="col-md-6">
                            <h4 class="list-group-item-heading"> {{ $row->titel }} </h4>
                            <p class="list-group-item-text">{{ $row->info }}
                            </p>
                        </div>
                        <div class="col-md-3 ">
                            <p>Mail contact: {{ $row->email }}</p>
                            <p>Telefoon contact: {{ $row->phone }}</p>
                            <div class="space">   
                                <span><a href="<?php echo 'EditInformatie/' . $row->id ?>" class="btn btn-info" role="button">Pas aan</a></span>
                                <span><a href="<?php echo 'DeleteInformatie/' . $row->id ?>" class="btn btn-info" role="button">Verwijder</a></span>
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

