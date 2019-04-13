@extends('layouts.app')

@section('content')

    
    <div class="container">
        @include('inc.messages')
        <br/>
        <div class="well">
            <h1 align=center>Projects</h1>
        </div>  
            <div style="background:transparent">
                {!! Form::open(['action'=>'ProjectController@index','method'=>'POST','enctype' => 'multipart/form-data']) !!}
                {!! csrf_field() !!}
                <div class="row">
                    <div class="col-md-2 offset-md-10">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Projects
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                            <li><a href="bungalow">Bungalow</a></li>
                            <li><a href="land">Land</a></li>
                            <li><a href="house">House</a></li>
                            <li><a href="flat">Flat</a></li>

                            </ul>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
                
                
                <br/>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card" id="panel">
                            <div class="card-header" id="panel-heading">
                                <span class="panel-heading">My Work</span>
                                <h2>RECENT Work</h2>
                            </div>
                            <div class="card-body" id="panel">
                                <br/>
                                <div class="row" id="div">
                                    @if (count($project_data) > 0)
                                        @foreach ($project_data as $item)
                                        
                                            <div class="col-md-4">
                                                <div class="card" id="panel" >
                                                    <div class="hvrbox">
                                                        <img class="img-fluid menu-thumbnails card-img-top" src="{{ asset('img/cover/'.$item->cover_image) }}"/>
                                                        <div class="hvrbox-layer_top">
                                                            <div class="hvrbox-text">{{$item -> deal_type}}<br/><a href="/project/{{$item -> id}}" class="btn btn-default" id="image_button">View Detail</a></div>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="card-body">
                                                        <h5 class="card-title"><a href="/project/{{$item -> id}}">{{$item -> title}}</a></h5>
                                                        <p class="card-text">{{$item -> location}} </p>
                                                        <a href="/project/{{$item -> id}}" class="btn btn-primary">view Detail</a>
                                                        <p><small>Uploaded on {{$item -> created_at}}</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        @endforeach
                                    @else
                                        <p>No post Found</p>
                                    @endif
                                </div>
                                <br/>
                                <div class="row">{{ $project_data -> links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

@endsection