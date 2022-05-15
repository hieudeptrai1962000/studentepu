@extends('layouts.master')
@section('title')
    Reset password
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Student</span><i
                    class="fa fa-angle-right"></i><span>Reset password</span></h2>
    </div>
    <div class="grid-form">
        @include('flash-message')
        <div class="grid-form1">
            {{Form::open(['route' => 'user.save.password','enctype' => 'multipart/form-data'])}}
            <div class="form-group" style="position: relative">
                {{Form::label('check1','Current Password:',['style' => 'font-weight:bold'])}}
                {{Form::password('old_password',['class' => 'form-control','id' =>"check1"])}}
                <a style="position: absolute; top:35px;right: 10px;color: #333" href="javascript:;void(0)"><i class="fa fa-eye"></i></a>
                @if($errors->has('old_password'))
                    <div class="error-text text-danger">
                        {{$errors->first('old_password')}}
                    </div>
                @endif
            </div>
            <div class="form-group" style="position: relative">
                {{Form::label('check2','New Password:',['style' => 'font-weight:bold'])}}
                {{Form::password('password',['class' => 'form-control','id' =>"check2"])}}
                <a style="position: absolute; top:35px;right: 10px;color: #333" href="javascript:;void(0)"><i class="fa fa-eye"></i></a>
                @if($errors->has('password'))
                    <div class="error-text text-danger">
                        {{$errors->first('password')}}
                    </div>
                @endif
            </div>
            <div class="form-group" style="position: relative">
                {{Form::label('check3','Confirm password:',['style' => 'font-weight:bold'])}}
                {{Form::password('re_password',['class' => 'form-control','id' =>"check3"])}}
                <a style="position: absolute; top:35px;right: 10px;color: #333" href="javascript:;void(0)"><i class="fa fa-eye"></i></a>
                @if($errors->has('re_password'))
                    <div class="error-text text-danger">
                        {{$errors->first('re_password')}}
                    </div>
                @endif
            </div>
            {{ Form::hidden('redirects_to', URL::previous()) }}
            {{Form::submit('Save', ['class'=> 'btn btn-success'])}}
            {{Form::close()}}
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function () {
            $('.form-group a').click(function () {
                let $this = $(this);

                if($this.hasClass('active')) {
                    $this.parents('.form-group').find('input').attr('type','password');
                    $this.removeClass('active');
                } else {
                    $this.parents('.form-group').find('input').attr('type','text');
                    $this.addClass('active');
                }
            })
        })
    </script>
@endsection