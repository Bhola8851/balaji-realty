@extends('layouts.app')

@section('content')
<br/><br/>
<div class="container">

    <div class="row">
        <div class="col-md-4">
                <a href="/project" class="btn btn-primary">Go Back</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div align='center' style="font-size:500%" class="">{{$project_data -> deal_type}}</div>
        </div>
    </div>
    <hr>
    <div class="row">

        <div class="col-md-6  mt-4">
            <!-- For image--><br><br>
            <img class="img-responsive img-fluid img-rounded" src="{{asset('img/cover/'.$project_data->cover_image)}}" alt="abc"  style="height:50vh; width:50vh;">

        </div>
        <!-- for Data -->
        <div class="col-md-6">
            <div class="card panel-default mb-5" id="panel">

                <div class="card-header panel-title" id="panel-heading">
                    <h2 class="h2" align="center"><strong> {{$project_data -> title}}</strong></h2>
                </div>
                <div class="card-body row" id="panel">
                    <div class="col-md-12">
                        <h5 align="center">Location :{{ $project_data -> location }}</h5><hr><br/>
                        <h5>Price : {{ $project_data -> price }} Lakhs<h5>  <br/>
                    </div>
                    <div class="col-md-12">
                        <h5>Address :</h5>
                        <h5>{{ $project_data -> address }}</h5>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <h5>Description:</h5>
                        <h5>{{ $project_data -> description }}</h5><br>
                    </div>
                </div>
                <div class="card-footer" id="panel">
                        <p align="center"><small style="display:inline-block">Posted on : {{$project_data -> created_at}}</small></p>
                </div>
            </div>
        </div>


        </div>
        <div class="row">
            <div class="col-md-12">
                <button id="searchMap" class="btn btn-primary" value="{{$project_data -> address}}">Click to view on Map</button>
                <br/><br/>
                <div id="map">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
