@extends('layouts.master')
@section('title')
    Edit mark
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Marks</span><i
                    class="fa fa-angle-right"></i><span>Edit mark</span></h2>
    </div>
    <div class="grid-form">
        <div class="content-top-1">
            {{Form::open(['route' =>'marks.store'])}}
            {{ Form::hidden('student_id', $mark->student->id) }}
            <div>
                @if($errors->has('student_id'))
                    <div class="error-text text-danger">
                        {{$errors->first('student_id')}}
                    </div>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('subject','Subject :') !!}
                {!! Form::select('subject_id',$subjects,$mark->subject->id, ['class' => 'form-control']) !!}
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
                {{Form::text('mark',$mark->mark,['class'=> 'form-control'])}}
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
