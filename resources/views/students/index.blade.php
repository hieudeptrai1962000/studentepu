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
            {{Form::open(['method' => 'GET', 'route' => 'students.index', 'class' => 'form-inline'])}}
            <div class="form-group" style="margin-right: 50px">
                {{Form::label('min1','Age from: ')}}
                {{Form::text('min_age',isset($data['min_age']) ? $data['min_age'] : null, ['id'=> 'min1','class' => 'form-control','style' => 'width: 60px'])}}
                {{Form::label('max1','To: ')}}
                {{Form::text('max_age',isset($data['max_age']) ? $data['max_age'] : null, ['id'=> 'max1','class' => 'form-control','style' => 'width: 60px'])}}
            </div>
            <div class="form-group">
                <label for="Subject">Subject</label>
                <select class="form-control" id="subject_search" name="subject_id">
                    <option value="">Select subject</option>
                    @foreach($subjects as $subject)
                        <option class=""
                                value="{{$subject->id}}" {{isset($data['subject_id']) && ($subject->id == $data['subject_id']) ? 'selected' : ''}} >
                            {{$subject->name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-left: 20px">
                {{Form::label('mark1','Mark from: ')}}
                {{Form::text('min_mark',isset($data['min_mark']) ? $data['min_mark'] : null, ['id'=> 'mark1','class' => 'form-control','style' => 'width: 60px'])}}
                {{Form::label('mark2','To: ')}}
                {{Form::text('max_mark',isset($data['max_mark']) ? $data['max_mark'] : null, ['id'=> 'mark2','class' => 'form-control','style' => 'width: 60px'])}}
            </div>
            <br><br>
            <div class="form-group">
                <span><b>Mobile network:</b></span>
                <div class="form-check" style="display: inline-block">
                    {{Form::checkbox('phones[viettel]','^(016[2-9]|09[678])[0-9]{7}$',!empty(\Request::get('phones')['viettel']) && \Request::get('phones')['viettel'] =='^(016[2-9]|09[678])[0-9]{7}$',['id' => 'check1'])}}
                    {{Form::label('check1','Viettel')}}

                </div>

                <div class="form-check" style="display: inline-block">
                    {{Form::checkbox('phones[mobiphone]','^(012[01268]|09[03])[0-9]{7}$',!empty(\Request::get('phones')['mobiphone']) && \Request::get('phones')['mobiphone'] == '^(012[01268]|09[03])[0-9]{7}$',['id' => 'check2'])}}
                    {{Form::label('check2','Mobiphone')}}
                </div>

                <div class="form-check" style="display: inline-block">
                    {{Form::checkbox('phones[vinaphone]','^(012[34579]|09[14])[0-9]{7}$',!empty(\Request::get('phones')['vinaphone']) && \Request::get('phones')['vinaphone'] == '^(012[34579]|09[14])[0-9]{7}$',['id' => 'check3'])}}
                    {{Form::label('check3','Vinaphone')}}
                </div>
                <div class="form-check" style="display: inline-block;margin-left: 50px">
                    {!! Form::label('check4','Complete all subject: ',['style' => 'font-weight:bold'] ) !!}
                    {{Form::checkbox('done','1',!empty(\Request::get('done')) && \Request::get('done') == 1,['id' => 'check4'])}}
                    {{Form::label('check5',' Or not')}}
                    {{Form::checkbox('not_done','1',!empty(\Request::get('not_done')) && \Request::get('not_done') == 1,['id' => 'check5'])}}

                </div>
                <div class="form-check" style="display: inline-block;margin-left: 50px">
                    {!! Form::label('check6','AVG < 5: ',['style' => 'font-weight:bold'] ) !!}
                    {{Form::checkbox('less_5','1',!empty(\Request::get('less_5')) && \Request::get('less_5') == 1,['id' => 'check6'])}}
                    {{Form::label('check7',' Or not')}}
                    {{Form::checkbox('greater_5','1',!empty(\Request::get('greater_5')) && \Request::get('greater_5') == 1,['id' => 'check7'])}}

                </div>
            </div>
            <br>
            <div style="display: flex;justify-content: center;margin-top: 20px">
                <button type="submit" class="btn btn-info"><i class="fa fa-search"></i></button>
            </div>

            {{Form::close()}}
            <table class="table table-hover table-bordered">
                @if(!Auth::check())
                    <a class="btn btn-sm btn-success pull-right" style="margin-top: 10px;margin-bottom: 10px"
                       href="{{route('register')}}" title=""><i class="fa fa-plus"></i></a>
                @endif
                <a class="btn btn-sm btn-danger pull-left" style="margin-top: 10px;margin-bottom: 10px"
                   href="{{route('students.bad')}}" title="">Send Email</a>
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <!--<th>Age</th>-->
                    <th style="width: 150px">Phone number</th>
                    <th>Avatar</th>
                    <th>Mark</th>
                    <th colspan="2" style="text-align: center;width: 30px">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $key =>  $student)
                    <tr id="{{'student_id'.$student->id}}">
                        <td>{{($students->currentPage() - 1 ) * $students->perPage() + $key +1}}</td>
                        <td id="{{'student_name_'.$student->id}}">{{$student->name}}</td>
                        <td id="{{'student_class_'.$student->id}}">{{isset($student->classRelation->name) ? $student->classRelation->name : ''}}</td>
                        <td id="{{'student_gender_'.$student->id}}">{{$student->gender}}</td>
                        <td id="{{'student_birthday_'.$student->id}}">{{date( 'd/m/Y',strtotime($student->birthday))}}</td>
                    <!-- <td>{{\Illuminate\Support\Carbon::parse($student->birthday)->age}}</td> -->
                        <td id="{{'student_phone_'.$student->id}}">{{(!empty ($student->phone_number)) ? rtrim($student->phone_number) : '' }}</td>
                        <td><img id="{{'student_image_'.$student->id}}"
                                 src="{{asset(pare_url_file( $student ->avatar))}}" alt="" class="img img-responsive"
                                 width="50px" height="50px"></td>
                        <td><a class="btn btn-success btn-sm" href="{{route('students.show',
                        ['student_id' => $student->id,
                        'subject_id' => !empty(\Request::get('subject_id')) ? \Request::get('subject_id') : 'all',
                        'min_mark' => !empty(\Request::get('min_mark')) ? \Request::get('min_mark') : 'all',
                        'max_mark' => !empty(\Request::get('max_mark')) ? \Request::get('max_mark') : 'all',])}}"
                               target="_blank"><i style="color: white" class="fa fa-share"></i></a></td>
                        <td style="">
                            <a class="btn btn-primary btn-sm edit-student" title="Edit" data-id="{{$student->id}}"
                               href="javascript:void(0)"><i class="fa fa-edit"
                                                            style="color: white"></i></a>
                        </td>
                        {{--                        @can('permission','admin')--}}
                        <td>
                            <div style="" class="d-inline-block" title="Delete"
                                 onclick="return confirm('Are you sure want to delete item ?')">
                                {{Form::open(['method' => 'DELETE', 'route' => ['students.destroy', $student->id]])}}
                                {!! Form::submit('&times;',['class' => 'btn btn-danger btn-sm']) !!}
                                {{Form::close()}}
                            </div>
                        </td>
                        {{--                        @endcan--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{$students->appends($data)->links()}}
    </div>
@endsection
@section('form_add')
    <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title" id="userCrudModal">Student information</h1>
                </div>
                <div class="modal-body">
                    <form id="user-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            {{Form::label('name','Student name:')}}
                            {{Form::text('name',null,['class' => 'form-control1','id' =>"name"])}}
                            <div class="error-text text-danger show-errors" id="name-error">

                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('birthday','Birthday:')}}
                            <br>
                            {{Form::date('birthday',null,['class' => 'form-control1','id' => 'birthday',"data-validation"=> "required"])}}
                            <div class="error-text text-danger show-errors" id="birthday-error">

                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('gender','Gender:')}}
                            <br>
                            {{Form::radio('gender','male',null,['id' => 'male_check'])}}
                            {{Form::label('male','Male')}}
                            {{Form::radio('gender','female',['id' =>'female_check'])}}
                            {{Form::label('female','Female',['class' => 'form-check-input'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('phone_number', 'Phone number: ',['style' => 'font-weight:bold'])}}
                            {{Form::text('phone_number',null,['class' => 'form-control1','id' =>"phone_number","data-validation"=> "required"])}}
                            <div>
                                <div class="error-text text-danger show-errors" id="phone-error">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            {{Form::label('avatar','Avatar: ')}}
                            {{Form::file('avatar',['id' => 'avatar'])}}
                            <img id="img_avatar" src="" alt=""
                                 class="img img-responsive"
                                 width="50px" height="50px">
                        </div>

                        <div class="error-text text-danger show-errors" id="avatar-error">

                        </div>
                        <div class="form-group">
                            {{Form::label('class_id','Class :')}}
                            {{Form::select('class_id',$classes,null,['class' => 'form-control1','placeholder' => 'choose class...','id' => 'class_id',"data-validation"=> "required"])}}
                            <div>
                                <div class="error-text text-danger show errors" id="class-error">

                                </div>
                            </div>
                        </div>
                        {{Form::hidden('student_id',null,['id' => 'student_id'])}}
                        {{Form::submit('Save', ['class'=> 'btn btn-success','id' => 'btn-save'])}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /*  When user click add user button */

            /* When click edit user */
            $(document).on('click', '.edit-student', function () {
                var student_id = $(this).data('id');
                $.get('ajax-students/' + student_id + '/show', function (data) {
                    $('#ajax-crud-modal').modal('show');
                    $('#name').val(data.name);
                    $('#student_id').val(data.id);
                    $('#birthday').val(data.birthday_form);
                    $('#phone_number').val(data.phone_number);
                    $('img#img_avatar').attr('src', data.avatar_form);
                    if (data.gender === 'male') {
                        $('#male_check').prop('checked', true);
                    } else {
                        $('#female_check').prop('checked', true);
                    }

                    $('.show-errors').html('');

                    $('select#class_id>option[value="' + data.class_id + '"').prop("selected", true);

                })
            });

        });

        $(document).on('submit', '#user-form', function (event) {
            event.preventDefault();
            $('#btn-save').val('Sending..');
            var student_id = $('#student_id').val();
            var data = new FormData(this);

            data.append('_method', 'put');

            $.ajax({
                url: "students/" + student_id,
                type: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    $('#student_name_' + data.id).html(data.name);
                    $('#student_class_' + data.id).html(data.class);
                    $('#student_gender_' + data.id).html(data.gender);
                    $('#student_birthday_' + data.id).html(data.birthday);
                    $('#student_phone_' + data.id).html(data.phone_number);
                    $('#student_image_' + data.id).attr('src', data.avatar);

                    $('#user-form').trigger("reset");
                    $('#ajax-crud-modal').modal('hide');
                    $('#btn-save').val('Save Changes');
                },
                error: function (data) {
                    if (data.responseJSON.errors) {
                        var errors = data.responseJSON.errors;
                        $('#name-error').html(errors.name ? errors.name + '<br>' : '');
                        $('#birthday-error').html(errors.birthday ? errors.birthday : '');
                        $('#class-error').html(errors.class_id ? errors.class_id : '');
                        // $('#phone-error').html(errors.phone_number ? errors.phone_number : '');
                        if (errors.phone_number) {
                            for (err of errors.phone_number) {
                                $('#phone-error').append(err + '<br>')
                            }
                        }
                        $('#avatar-error').html(errors.avatar ? errors.avatar : '');

                        $('#btn-save').val('Save Changes');
                    }

                }
            });
        })

    </script>
@endsection
