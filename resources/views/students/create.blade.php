@extends('layouts.master')
@section('title')
    Create student
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Student</span><i
                    class="fa fa-angle-right"></i><span>Create student</span></h2>
    </div>
    <div class="grid-form">
        <div class="grid-form1">
            <div class="row">
                <div class="col-md-6">
                    <h1>Student information</h1>
                    {{Form::open(['route' => 'register','enctype' => 'multipart/form-data'])}}
                    <div class="form-group">
                        {{Form::label('exampleInputEmail1','Student name:',['style' => 'font-weight:bold'])}}
                        {{Form::text('name',null,['class' => 'form-control','id' =>"exampleInputEmail1"])}}
                        @if($errors->has('name'))
                            <div class="error-text text-danger">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('birth day','Birthday:',['style' => 'font-weight:bold'])}}
                        <br>
                        {{Form::date('birthday','1999-12-20' ),['class' => 'form-control']}}
                        @if($errors->has('birthday'))
                            <div class="error-text text-danger">
                                {{$errors->first('birthday')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {!! Form::label('gender','Gender:',['style' => 'font-weight:bold']) !!}
                        <br>
                        {{Form::radio('gender','male')}}
                        {{Form::label('male','Male',['class' => 'form-check-input'])}}
                        {{Form::radio('gender','female')}}
                        {{Form::label('female','Female',['class' => 'form-check-input'])}}
                        <div>
                            @if($errors->has('gender'))
                                <div class="error-text text-danger">
                                    {{$errors->first('gender')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('phone number', 'Phone number: ',['style' => 'font-weight:bold'])}}
                        {{Form::text('phone_number',null,['class' => 'form-control1','id' =>"exampleInputEmail1"])}}
                        <div>
                            @if($errors->has('phone_number'))
                                <div class="error-text text-danger">
                                    {{$errors->first('phone_number')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('avatar','Avatar: ',['style' => 'font-weight:bold'])}}
                        {!! Form::file('avatar') !!}
                    </div>
                    @if($errors->has('avatar'))
                        <div class="error-text text-danger">
                            {{$errors->first('avatar')}}
                        </div>
                    @endif
                    <div class="form-group">
                        {{Form::label('class','Class :',['style' => 'font-weight:bold'])}}
                        {{Form::select('class_id',$classes,null, ['class' => 'form-control1','placeholder' => 'choose class...'])}}
                        <div>
                            @if($errors->has('class_id'))
                                <div class="error-text text-danger">
                                    {{$errors->first('class_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('role','Your role:',['style' => 'font-weight:bold']) !!}
                        <br>
                        {{Form::radio('permission','user',null,['checked'])}}
                        {{Form::label('user','User',['class' => 'form-check-input'])}}
                        {{Form::radio('permission','admin')}}
                        {{Form::label('admin','Admin',['class' => 'form-check-input'])}}
                        <div>
                            @if($errors->has('permission'))
                                <div class="error-text text-danger">
                                    {{$errors->first('permission')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h1>Login information</h1>
                    <div class="form-group" style="margin-top: 24px">
                        {{Form::label('check1','Username:',['style' => 'font-weight:bold'])}}
                        {{Form::text('username',null,['class' => 'form-control','id' =>"check1"])}}
                        @if($errors->has('username'))
                            <div class="error-text text-danger">
                                {{$errors->first('username')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('email','Email :',['style' => 'font-weight:bold'])}}
                        {{Form::email('email',null,['class' => 'form-control','id' =>"email"])}}
                        @if($errors->has('email'))
                            <div class="error-text text-danger">
                                {{$errors->first('email')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('check2','Password:',['style' => 'font-weight:bold'])}}
                        {{Form::password('password',['class' => 'form-control','id' =>"check2"])}}
                        @if($errors->has('password'))
                            <div class="error-text text-danger">
                                {{$errors->first('password')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('check3','Confirm password:',['style' => 'font-weight:bold'])}}
                        {{Form::password('re_password',['class' => 'form-control','id' =>"check3"])}}
                        @if($errors->has('re_password'))
                            <div class="error-text text-danger">
                                {{$errors->first('re_password')}}
                            </div>
                        @endif
                    </div>

                    {{ Form::hidden('redirects_to', URL::previous()) }}
                    {{Form::submit('Create', ['class'=> 'btn btn-success'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endsection
