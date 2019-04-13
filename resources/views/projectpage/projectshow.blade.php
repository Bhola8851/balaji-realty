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
            <h1 align='center' class="">{{$project_data -> deal_type}}</h1>
        </div>
    </div>
    <hr><br>
    <div class="row">
        
        <div class="col-md-6  mt-5">
            <!-- For image-->
            <img class="img-responsive img-fluid" src="{{asset('img/cover/'.$project_data->cover_image)}}" alt="abc"  style="height:50vh; width:50vh;">

        </div>
        <!-- for Data -->
        <div class="col-md-6">
            <div class="card panel-default" id="panel">
                <div class="card-header panel-title" id="panel-heading">
                    <h1 class="h1"><strong> {{$project_data -> title}}</strong></h1>
                </div>
                <div class="card-body row" id="panel">
                    <div class="col-md-12">
                        <p class="h3"><strong>Location : {{ $project_data -> location }}</strong></p>
                        <p class="h3">Price : <span class="h5">{{ $project_data -> price }}Lakhs</span> </hp> <br/>   
                    </div> 
                    <div class="col-md-12">
                        <p class="h2">Description:</p>
                        <p>{{ $project_data -> description }}</p><br/>
                    </div>
                    <div class="col-md-12">
                        <p class="h3"><strong class="h3">Address :</strong> </p>
                        <p>{{ $project_data -> address }}</p>
                        <hr>
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