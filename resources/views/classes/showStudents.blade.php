@extends('layouts.master')
@section('title')
    Student list
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Class</span><i
                    class="fa fa-angle-right"></i><span>Create class</span></h2>
    </div>
    @include('flash-message')
    <div class="grid-form">
        <div class="content-top-1">
            <table class="table table-hover table-bordered">
                <h3 class="page-header">Student Manager<a class="btn btn-sm btn-success pull-right"
                                                          href="{{route('students.create')}}" title=""><i
                                class="fa fa-plus"></i></a></h3>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Student name</th>
                    <th>Class</th>
                    <th>Gender</th>
                    <th>Avatar</th>
                    <th>Birthday</th>
                    <th>Mark</th>
                    <th colspan="2" style="text-align: center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $key =>  $student)
                    <tr style="">
                        <td>{{($students->currentPage() - 1 ) * $students->perPage() + $key +1}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->classRelation->name}}</td>
                        <td>{{$student->gender}}</td>
                        <td><img src="{{asset(pare_url_file( $student ->avatar))}}" alt="" class="img img-responsive"
                                 width="50px" height="50px"></td>
                        <td>{{date( 'd/m/Y',strtotime($student->birthday))}}</td>
                        <td><a class="btn btn-success btn-sm" href="{{route('students.show',$student->id)}}">Show
                                mark</a></td>
                        <td style="">
                            <a class="btn btn-primary btn-sm" style="margin-right: 10px"
                               href="{{route('students.edit', $student->id)}}">Edit</a>
                        </td>
                        @can('permission','admin')
                        <td>
                            <div style="" class="d-inline-block"
                                 onclick="return confirm('Are you sure want to delete item ?')">
                                {{Form::open(['method' => 'DELETE', 'route' => ['students.destroy', $student->id]])}}
                                {{Form::submit('Delete',['class' => 'btn btn-danger btn-sm'])}}
                                {{Form::close()}}
                            </div>
                        </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$students->links()}}
        </div>
    </div>
@endsection