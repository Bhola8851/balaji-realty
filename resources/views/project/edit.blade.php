@extends('layouts.app')
@section('content')
<br><br>
<div class="container">
    <div class="row">
        <a href="/posts" class="btn btn-default">Go Back</a>
        <br/>
        <br/>
        <div class="well text-center" style="background:#b2b2b2">
            <h1>Edit Deal</h1>
        </div>
        <div class="col-md-12">
        @include('inc.messages')
        {!! Form::open(['action'=>['PostsController@update',$posts_data -> id],'method'=>'POST','enctype' => 'multipart/form-data']) !!}
            {!! csrf_field() !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::label('deal_type','Type Of Deal')}}
                        {{Form::select('deal_type',['Bungalow' => 'Bungalow','House' => 'House' ,'Land' => 'Land','Flat'=>'Flat'],$posts_data->deal_type,['style' => 'color:#000000;'])}}
                    </div>  
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::label('location','Location')}}
                        {{Form::select('location',['Palghar' => 'Palghar','Virar' => 'Virar' ,'Boisar' => 'Boisar'],$posts_data->location,['style' => 'color:#000000;'])}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::label('title','Title')}}
                        {{Form::text('title',$posts_data -> title,['class' => 'form-control','placeholder' => 'Enter title'])}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::label('price','Price(in Lakhs)')}}
                        {{Form::text('price',$posts_data -> price,['class' => 'form-control','placeholder' => 'Enter price'])}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::label('address',' Full Address')}}
                        {{Form::text('address',$posts_data -> address,['class' => 'form-control','placeholder' => 'Enter Full project address'])}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::label('description','Description')}}
                        {{Form::textarea('description',$posts_data -> description,['class' => 'form-control','placeholder' => 'Enter Description'])}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{Form::file('cover_image')}}
                    </div>
                </div>
                
            </div>
            {{Form::hidden('_method','PUT')}}
            {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection