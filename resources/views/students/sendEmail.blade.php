@extends('layouts.master')
@section('title')
    Student list
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Student</span><i
                    class="fa fa-angle-right"></i><span>List students</span></h2>
    </div>
    <div class="grid-form">
        @include('flash-message')
        <div class="content-top-1">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Student name</th>
                    <th>Class</th>
                    <th>Email</th>
                    <th style="width: 150px">Phone number</th>
                    <th>Mark</th>
                    <th>Send</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $key =>  $student)
                    <tr>
                        <td>{{$student->id}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{isset($student->classRelation->name) ? $student->classRelation->name : ''}}</td>
                        <td>{{$student->user->email}}</td>
                        <td>{{(!empty ($student->phone_number)) ? rtrim($student->phone_number) : '' }}</td>
                        <td><a class="btn btn-success btn-sm"  href="{{route('students.show',$student->id)}}" target="_blank"><i style="color: white" class="fa fa-share"></i></a></td>
                        <td >
                            <a class="btn btn-danger click" href="{{route('students.sendEmail',['id'=>$student->user->id])}}" ><i class="fa fa-send " style="color: white"></i></a>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div style="display: flex;justify-content: center;margin-top: 20px"><a href="{{route('students.sendAll')}}" class="btn btn-danger send-all">Send to all</a></div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('click','.click',function () {
                $(this).children('i.fa-send').css({'color':'black'});
            });

            $(document).on('click','.send-all',function () {
                $('i.fa-send').css({'color':'black'});
            })
        })
    </script>
@endsection