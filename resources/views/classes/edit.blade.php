@extends('layouts.master')
@section('title')
    Edit class
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Class</span><i
                    class="fa fa-angle-right"></i><span>Edit class</span></h2>
    </div>
    <div class="grid-form">
        <div class="grid-form1">
            {{Form::open(['method' => 'PUT','route' => ['classes.update',$class->id]])}}
            <div class="form-group">
                {{Form::label('name', 'Class name :')}}
                {{Form::text('name',$class->name,['class'=> 'form-control1'])}}
                @if($errors->has('name'))
                    <div class="error-text text-danger">
                        {{$errors->first('name')}}
                    </div>
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('faculty','Faculty :') !!}
                {!! Form::select('faculty_id',$faculties,isset($class->faculty->id) ? $class->faculty->id : null, ['class' => 'form-control1 custom-select mr-sm-2','placeholder' => 'choose faculty...']) !!}
            </div>
            <div>
                @if($errors->has('faculty_id'))
                    <div class="error-text text-danger">
                        {{$errors->first('faculty_id')}}
                    </div>
                @endif
            </div>
            {{ Form::hidden('redirects_to', URL::previous()) }}
            {{Form::submit('Save', ['class'=> 'btn btn-success'])}}
            {{Form::close()}}
        </div>
    </div>
@endsection
