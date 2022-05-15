@extends('layouts.master')
@section('title')
Create subject
@endsection
@section('content')
    <div class="banner">
    <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Subject</span><i class="fa fa-angle-right"></i><span>Create subject</span></h2>
    </div>
    <div class="grid-form">
    <div class="grid-form1">
        {{Form::open(['route' => 'subjects.store'])}}
        <div class="form-group">
            {{Form::label('name', 'Subject name')}}
            {{Form::text('name','',['class'=> 'form-control1'])}}
            @if($errors->has('name'))
                <div class="error-text text-danger">
                    {{$errors->first('name')}}
                </div>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('faculty','Faculty') !!}
            {!! Form::select('faculty_id',$faculties,null, ['class' => 'form-control1','placeholder' => 'choose faculty...']) !!}
        </div>
        <div>
            @if($errors->has('faculty_id'))
                <div class="error-text text-danger">
                    {{$errors->first('faculty_id')}}
                </div>
            @endif
        </div>
        {{ Form::hidden('redirects_to', URL::previous()) }}
        {{Form::submit('create', ['class'=> 'btn btn-success'])}}
        {{Form::close()}}
    </div>
</div>
@endsection
