@extends('layouts.master')
@section('title')
    Create Mark
@endsection
@section('content')
    <div class="banner">
        <h2><a href="">Home</a><i class="fa fa-angle-right"></i><span>Student</span><i
                    class="fa fa-angle-right"></i><span>Create marks</span></h2>
    </div>
    <div class="grid-form">
        @if ($errors->any())
            <div class="alert alert-danger">
                <span>{{ 'subjects and marks cannot be null, mark from 0 to 10' }}</span>
                <button type="button" class="close" data-dismiss="alert">×</button>
            </div>
        @endif
        <div class="content-top-1">
            <h3 style="color:#5a6268;">{{$student->name}}</h3>
            {{Form::open(['route' => ['marks.storeMore','student_id' => $student->id],'id'=>'my_form'])}}
            <div id="page-load">
                <p id="number-subject" style="display: none">{{count($subjects)}}</p>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Mark</th>
                        <th class="clickadd"><i class="fa fa-plus btn btn-primary"></i></th>
                    </tr>
                    </thead>
                    <tbody id="form-add">

                    @if(!empty(old('subject_id')))
                    @else
                    @if(isset($marks))
                        @foreach($marks as $mark)
                            <tr  class="studentmark">
                                <td class="with-add">
                                    <select name="subject_id[]" class="form-control" data-validation="required">
                                        <option value="">choose subject...</option>
                                    @foreach($subjects as $subject)
                                        <option
                                            value="{{$subject->id}}" {{$subject->id === $mark->subject_id ?'selected' :''}}>
                                            {{$subject->name}}
                                        </option>
                                    @endforeach
                                    </select>
                                </td>
                                <td class="with-add">
                                    <input class="form-control mark" name="mark[]" type="text" value="{{$mark->mark}}" data-validation-allowing="range[0;10]" data-validation="number">
                                </td>
                                <td>
                                    <i class="fa fa-remove btn btn-danger remove-item" style="color: white"></i>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @endif
                    @if(!empty(old('subject_id')))
                        @foreach(old('subject_id') as $key =>  $subject_id)
                            <tr  class="studentmark">
                                <td class="with-add">
                                    <select name="subject_id[]" class="form-control" >
                                        <option value="">choose subject...</option>
                                        @foreach($subjects as $subject)
                                            <option
                                                    value="{{$subject->id}}" {{$subject->id == $subject_id ?'selected' : ''}}>
                                                {{$subject->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="with-add">
                                    <input class="form-control mark" name="mark[]" type="text" value="{{old('mark')[$key]}}" data-validation-allowing="range[0;10]" data-validation="number">
                                </td>
                                <td>
                                    <i class="fa fa-remove btn btn-danger remove-item" style="color: white"></i>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    <tr class="addform" style="display: none">
                        <td class="with-add">
                            <select name="subject_id[]" class="form-control addselect" data-validation="required">
                                <option value="">choose subject...</option>
                                @foreach($subjects as $key => $subject)
                                    <option value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="with-add">
                            <input type="text" class="form-control" name="mark[]" data-validation-allowing="range[0;10]" data-validation="number">
                        </td>
                        <td><i class="fa fa-remove btn btn-danger remove-item" style="color: white"></i>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            {{ Form::hidden('redirects_to', URL::previous()) }}
            <div class="clearfix"></div>
            {{Form::submit('Save', ['class'=> 'btn btn-success','id'=>'saveform'])}}
            {{Form::close()}}


        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">

        $(document).ready(function () {
            //add
            form = $('tr.addform').html();
            $('.clickadd').click(function () {
                var len = $('tbody#form-add tr').length;
                var subject = $('p#number-subject').html();
                if(len -1 <  subject) {
                    $('#form-add').append('<tr>' + form + '</tr>');
                } else {alert('student has '+ subject + ' subject !')}
                var $select = $("select");
                var selected = [];
                var unselected = [];
                $.each($select, function (index, select) {
                    if (select.value !== "") {
                        selected.push(select.value);
                    }
                });
                $("option").prop("disabled", false);
                for (var index in selected) {
                    $('option[value="' + selected[index] + '"]').css("display","none");
                }

                $.each($select, function (index, select) {
                    if (select.value === "") {
                        unselected.push(select.value);
                    }
                });

                for (var item in unselected) {
                    $('option[value="' + unselected[item] +'"]').css("display","block");
                }
            });

            //remove
            $(document).on('click','.remove-item', function () {
                    $(this).parent().parent().remove();
                var $select = $("select");
                var selected = [];
                var unselected = [];
                $.each($select, function (index, select) {
                    if (select.value !== "") {
                        selected.push(select.value);
                    }
                });
                var del =  $(this).parent().parent().find('select').val();
                selected.splice(selected.indexOf(del.toString()),1);
                $("option").prop("disabled", false);
                for (var index in selected) {
                    $('option[value="' + selected[index] +'"]').css("display","none");
                }

                $.each($select, function (index, select) {
                    if (select.value === "") {
                        unselected.push(select.value);
                    }
                });

                for (var value in unselected) {
                    $('option[value="' + selected[value] +'"]').css("display","block");
                }
            });
            //select
            $(document).on('click','select',function () {
                var $select = $("select");
                var selected = [];
                $.each($select, function (index, select) {
                    if (select.value !== "") {
                        selected.push(select.value);
                    }
                });
                $('select > option').not(this).css('display','block');
                $("option").prop("disabled", false);
                for (var index in selected) {
                    $('option[value="' + selected[index] +'"]').css("display","none");
                }
                // $(this).parent().parent().find('td > i.remove-item').on('click',function () {
                //     var del =  $(this).val();
                //     selected.splice(selected.indexOf(del.toString()),1);
                //     for (var index in selected) {
                //         $('option[value="' + selected[index] +'"]').css("display","block");
                //     }
                // });
            });

            $('#saveform').on('click',function () {
                    $('tr.addform').remove();
            });

        });

    </script>
@endsection
