@extends('layouts.master')
@section('title')
Faculty list
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Faculties</span><i class="fa fa-angle-right"></i><span>List faculties</span></h2>
    </div>

    <div class="grid-form">
        @include('flash-message')
        <div class="content-top-1">
        <table class="table table-hover table-bordered">
            <h3 class="page-header">Faculty Manage<a class="btn btn-sm btn-success pull-right" href="{{route('faculties.create')}}" title=""><i class="fa fa-plus"></i></a></h3>
            <thead>
            <tr>
                <th>#</th>
                <th>Faculty name</th>
                <th>Show class</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @if (isset($faculties))
                @foreach($faculties as $key => $faculty)
                    <tr>
                        <td>{{(($faculties->currentPage() - 1 ) * $faculties->perPage() ) + $key +1}}</td>
                        <td>{{$faculty->name}}</td>
                        <td><a class="btn btn-success btn-sm" href="{{route('faculties.show', $faculty->id)}}" target="_blank">Show class</a></td>
                        <td style="display: flex;border-collapse: collapse">
                            <a class="btn btn-primary btn-sm" style="margin-right: 10px" href="{{route('faculties.edit', $faculty->id)}}">Edit</a>
{{--                            @can('permission','admin')--}}
                            <div style="" class="d-inline-block" onclick="return confirm('Are you sure want to delete item ?')">
                                {{Form::open(['method' => 'DELETE', 'route' => ['faculties.destroy', $faculty->id]])}}
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
        {{$faculties->links()}}
        </div>
    </div>
@endsection