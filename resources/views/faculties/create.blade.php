@extends('layouts.master')
@section('title')
Create faculty
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Faculties</span><i class="fa fa-angle-right"></i><span>Create faculty</span></h2>
    </div>
<div class="grid-form">
    <div class="grid-form1">
        {{Form::open(['route' => 'faculties.store'])}}
        <div class="form-group">
            {{Form::label('name','Faculty name :')}}
        </div>
        <div class="form-group">
            {{Form::text('name','',['class' => 'form-control1'])}}
        </div>
        @if($errors->has('name'))
            <div class="error-text text-danger">
                {{$errors->first('name')}}
            </div>
        @endif
        {{ Form::hidden('redirects_to', URL::previous()) }}
        {{Form::submit('Submit', ['class'=> 'btn btn-success'])}}
        {{Form::close()}}
    </div>
</div>
@endsection
