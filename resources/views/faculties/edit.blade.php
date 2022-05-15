@extends('layouts.master')
@section('title')
    Edit faculty
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Faculties</span><i
                    class="fa fa-angle-right"></i><span>Edit faculty</span></h2>
    </div>
    <div class="grid-form">
        <div class="grid-form1">
            {{Form::open(['method'=>'PUT','route' => ['faculties.update',$faculty->id]])}}
            <div class="form-group">
                {{Form::label('name','Faculty name :')}}
            </div>
            <div class="form-group">
                {{Form::text('name',$faculty->name,['class' => 'form-control1'])}}
            </div>
            @if($errors->has('name'))
                <div class="error-text text-danger">
                    {{$errors->first('name')}}
                </div>
            @endif
            {{ Form::hidden('redirects_to', URL::previous()) }}
            {{Form::submit('Save', ['class'=> 'btn btn-success'])}}
            {{Form::close()}}
        </div>
    </div>
@endsection
