@extends('layouts.master')
@section('title')
    Create mark
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Marks</span><i
                    class="fa fa-angle-right"></i><span>Create mark</span></h2>
    </div>
    <div class="grid-form">
        <div class="content-top-1">
            {{Form::open(['route' => 'marks.store'])}}
            <div class="form-group">
                {!! Form::label('student','Student: ') !!}
                {!! Form::select('student_id',$data['students'],null, ['class' => 'form-control','placeholder' => 'choose student...','id' => 'student']) !!}
            </div>
            <div>
                @if($errors->has('student_id'))
                    <div class="error-text text-danger">
                        {{$errors->first('student_id')}}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('subject','Subject: ') !!}
                {!! Form::select('subject_id',$data['subjects'],null, ['class' => 'form-control','placeholder' => 'choose subject...','id' => 'subject']) !!}
            </div>
            <div>
                @if($errors->has('subject_id'))
                    <div class="error-text text-danger">
                        {{$errors->first('subject_id')}}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {{Form::label('mark', 'Mark :')}}
                {{Form::text('mark','',['class'=> 'form-control'])}}
                @if($errors->has('mark'))
                    <div class="error-text text-danger">
                        {{$errors->first('mark')}}
                    </div>
                @endif
            </div>
            {{ Form::hidden('redirects_to', URL::previous()) }}
            {{Form::submit('Save', ['class'=> 'btn btn-success'])}}
            {{Form::close()}}
        </div>
    </div>
@endsection
