@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Meldingen</div>

                <div class="list-group">
                    <div class="list-group-item">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Titel</th>
                                    <th>Categorie</th>
                                    <th>E-mail</th>
                                    <th>Datum</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meldingen as $row)
                                <tr>
                                    <td>{{ $row->titel }}</td>
                                    <td>{{ $row->categorie }}</td>
                                    <td>{{ $row->mail }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    <td>
                                        <span><a href="<?php echo 'meldingDetails/' . $row->id ?>" class="btn btn-info" role="button">details</a></span>
                                        <span><a href="<?php echo 'DeleteMelding/' . $row->id ?>" class="btn btn-info" role="button">Verwijder</a></span> 
                                    </td>
                                </tr>
                                @endforeach 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection

