@extends('layouts.master')
@section('title')
Class list
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Class</span><i class="fa fa-angle-right"></i><span>Create class</span></h2>
    </div>

    <div class="grid-form">
        @include('flash-message')
        <div class="content-top-1">
        <table class="table-bordered table table-hover">
            <h3 class="page-header">Classes Manage<a class="btn btn-sm btn-success pull-right" href="{{route('classes.create')}}" title=""><i class="fa fa-plus"></i></a></h3>
            <thead>
            <tr>
                <th>#</th>
                <th>Class name</th>
                <th>Faculty</th>
                <th>Show students</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if (isset($classes))
                @foreach($classes as $key => $class)
                    <tr>
                        <td>{{(($classes->currentPage() - 1 ) * $classes->perPage() ) + $key +1}}</td>
                        <td>{{$class->name}}</td>
                        <td>{{isset($class->faculty->name) ? $class->faculty->name : ''}}</td>
                        <td><a class="btn btn-success btn-sm" href="{{route('classes.show', $class->id)}}" target="_blank">Show student</a></td>
                        <td style="display: flex">
                            <a class="btn btn-primary btn-sm"  style="margin-right: 10px"  href="{{route('classes.edit',$class->id)}}" >Edit</a>
{{--                            @can('permission','admin')--}}
                            <div onclick="return confirm('Are you sure want to delete item ?')">
                                {{Form::open(['method' => 'DELETE', 'route' => ['classes.destroy', $class->id]])}}
                                {{Form::submit('Delete',['class' => 'btn btn-danger btn-sm'])}}
                                {{Form::close()}}
                            </div>
{{--                            @endcan--}}
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        </div>
        {{$classes ->links()}}
    </div>
@endsection