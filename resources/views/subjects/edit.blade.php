@extends('layouts.master')
@section('title')
Edit Subject
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Subject</span><i class="fa fa-angle-right"></i><span>Edit subject</span></h2>
    </div>
<div class="grid-form">
    <div class="content-top-1">
        {{Form::open(['method' => 'PUT','route' =>['subjects.update',$subject->id]])}}
        <div class="form-group">
            {{Form::label('name', 'Subject name: ')}}
            {{Form::text('name',$subject->name,['class'=> 'form-control'])}}
            @if($errors->has('name'))
                <div class="error-text text-danger">
                    {{$errors->first('name')}}
                </div>
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('faculty','Faculty') !!}
            {!! Form::select('faculty_id',$faculties,isset($subject->faculty_id) ? $subject->faculty_id : '', ['class' => 'form-control','placeholder' => 'choose faculty...']) !!}
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
