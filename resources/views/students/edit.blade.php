@extends('layouts.master')
@section('title')
    Edit student
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Student</span><i
                    class="fa fa-angle-right"></i><span>Edit student</span></h2>
    </div>
    <div class="grid-form">
        @include('flash-message')
        <div class="grid-form1">
            <div class="row">
                <div class="col-md-6">
                    <h1>Student information</h1>
                    {{Form::open(['method' => 'PUT','enctype' => 'multipart/form-data','route' => ['students.update',$student->id]])}}
                    <div class="form-group">
                        {{Form::label('exampleInputEmail1','Student name:')}}
                        {{Form::text('name',isset($student->name) ? $student->name : '',['class' => 'form-control1','id' =>"exampleInputEmail1"])}}
                        @if($errors->has('name'))
                            <div class="error-text text-danger">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('birth day','Birthday:')}}
                        <br>
                        {{Form::date('birthday',isset($student->birthday) ? date('Y-m-d',strtotime($student->birthday)) :\Carbon\Carbon::now()),['class' => 'form-control1','id' => 'example-date-input']}}
                        @if($errors->has('birthday'))
                            <div class="error-text text-danger">
                                {{$errors->first('birthday')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('gender','Gender:')}}
                        <br>
                        {{Form::radio('gender','male',null,[(isset($student->gender) && $student->gender == 'male')? 'checked' : ''])}}
                        {{Form::label('male','Male')}}
                        {{Form::radio('gender','female',null,[(isset($student->gender) && $student->gender == 'female')? 'checked' : ''])}}
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
                        {{Form::text('phone_number',isset($student->phone_number) ? $student->phone_number : '',['class' => 'form-control1','id' =>"exampleInputEmail1"])}}
                        <div>
                            @if($errors->has('phone_number'))
                                <div class="error-text text-danger">
                                    {{$errors->first('phone_number')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('avatar','Avatar: ')}}
                        {{Form::file('avatar')}}
                        <img src="{{asset(pare_url_file( $student ->avatar))}}" alt="" class="img img-responsive"
                             width="50px" height="50px">
                    </div>

                    @if($errors->has('avatar'))
                        <div class="error-text text-danger">
                            {{$errors->first('avatar')}}
                        </div>
                    @endif
                    <div class="form-group">
                        {{Form::label('class','Class :')}}
                        {{Form::select('class_id',$classes,isset($student->classRelation->id) ? $student->classRelation->id : null , ['class' => 'form-control1','placeholder' => 'choose class...'])}}
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
                        {{Form::radio('permission','user',null,[(isset($student->user->permission) && $student->user->permission == 'user')? 'checked' : ''])}}
                        {{Form::label('user','User',['class' => 'form-check-input'])}}
                        {{Form::radio('permission','admin',null,[(isset($student->user->permission) && $student->user->permission == 'admin')? 'checked' : ''])}}
                        {{Form::label('admin','Admin',['class' => 'form-check-input'])}}
                        <div>
                            @if($errors->has('permission'))
                                <div class="error-text text-danger">
                                    {{$errors->first('permission')}}
                                </div>
                            @endif
                        </div>
                    </div>
                    {{ Form::hidden('redirects_to', URL::previous()) }}
{{--                    {{Form::submit('Save', ['class'=> 'btn btn-success'])}}--}}
{{--                    {{Form::close()}}--}}
                </div>
                <div class="col-md-6">
                    <h1>Login information</h1>
                    <div class="form-group" style="margin-top: 24px">
                        {{Form::label('check1','Username:',['style' => 'font-weight:bold'])}}
                        {{Form::text('username',isset($student->user->username) ? $student->user->username : '',['class' => 'form-control','id' =>"check1"])}}
                        @if($errors->has('username'))
                            <div class="error-text text-danger">
                                {{$errors->first('username')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        {{Form::label('email','Email :',['style' => 'font-weight:bold'])}}
                        {{Form::email('email',isset($student->user->email) ? $student->user->email : '',['class' => 'form-control','id' =>"email"])}}
                        @if($errors->has('email'))
                            <div class="error-text text-danger">
                                {{$errors->first('email')}}
                            </div>
                        @endif
                    </div>
                    {{ Form::hidden('redirects_to', URL::previous()) }}
                    {{Form::submit('Save', ['class'=> 'btn btn-success'])}}
                    {{Form::close()}}
                    <a class="btn btn-primary" href="{{route('user.update.password')}}">Update password</a>
                </div>
            </div>
        </div>
    </div>
@endsection
