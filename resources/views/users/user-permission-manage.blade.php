@extends('layouts.app')
<style>
    .type-none {
        list-style-type: none;
        padding-left: 5px;
    }
</style>
@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
    <li class="active">
        <strong>หน้าหลัก</strong>
    </li>
</ol>
@endsection

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="card-header">
        <h5 class="card-title">
            <h3>User</h3>
        </h5>


    </div>
    <div class="card-body">
        <div id="wrapper">
            <div class="card-body">
                <form action="/save-user-permission" method="POST" id="permission-lists">
                    @csrf
                    <div class="col-md-12" id="show-user">

                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                บันทึกข้อมูล</button>
                        </div>
                        @foreach ($groups as $group)
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="alert alert-info">
                                        @if (count($group->subgroups))
                                        <!--main group-->
                                        <input type="checkbox" class="main-input"
                                            id="group_{{$group->id}}">
                                        @endif
                                        <label for="group_{{$group->id}}">{{$group->name}}</label></h4>
                                </div>
                                <div class="col-md-12" style="margin-left: 15px;">
                                    @if (count($group->subgroups))
                                    @foreach ($group->subgroups as $subgroup)
                                    <!--sub group-->
                                    <strong><input type="checkbox" id="sub_group_{{$subgroup->id}}" main-input="group_{{$group->id}}" class="group-perms group_{{$group->id}} sub-input"> {{$subgroup->name}}</strong>
                                    <ul style="list-style-type:none;padding-left:1.5em;">
                                        @foreach ($subgroup->permission as $permission)
                                         <!--permission-->
                                        <li><input type="checkbox" sub-input="sub_group_{{$subgroup->id}}" main-input="group_{{$group->id}}" class="group-perms group_{{$group->id}} sub_group_{{$subgroup->id}}" value="{{$permission->id}}" id="perm_{{$permission->id}}" name="permissions[]"> {{$permission->description}}</li>
                                        @endforeach
                                    </ul>
                                    @endforeach
                                    @else
                                    <strong class="text-secondary">- ไม่มีข้อมูล</strong>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>







@endsection
@section('script')
<script>
    get_user_permission = () => {
        if('{{$user_id}}'){
            $.post("/get_edit_permission", data = {
                user_id: '{{$user_id}}',
                _token: '{{ csrf_token() }}',
            },
                function (res) {
                    res.forEach(element => {
                        $(`#perm_${element.permission_id}`).prop('checked',true);
                    });
                },
            );
        }
    }

    $('.group-perms').change(function () {
        // for sub
        let checkbox_sub = $(this).attr('sub-input');
        let sub_group = $(`.${checkbox_sub}`);
        let sub_check = 0;
        sub_group.each(function () {
            if ($(this).is(":checked")) {
                sub_check++;
            } else {
                $(`#${checkbox_sub}`).prop('checked', false);
            }
        });
        if (sub_group.length == sub_check) {
            $(`#${checkbox_sub}`).prop('checked', true);
        }

        // for main
        let checkbox = $(this).attr('main-input');
        let main_group = $(`.${checkbox}`);
        let main_check = 0;
        main_group.each(function () {
            if ($(this).is(":checked")) {
                main_check++;
            } else {
                $(`#${checkbox}`).prop('checked', false);
            }
        });
        if (main_group.length == main_check) {
            $(`#${checkbox}`).prop('checked', true);
        }    
    });

 

    function get_user_data() {
        if ('{{$user_id}}') {
            $('#show-user').append(`
                <input type="hidden" name="user_id[]" value="{{$user_id}}">
            `);
        }else{
            user_data = JSON.parse(localStorage.getItem("user-permissions"));
            if (user_data) {
                let i = 0;
                user_data.forEach(element => {
                    i++;
                    $('#show-user').append(`
            <span class="col badge badge-success" style="padding-right:1rem;">${i}. ${element.user_name} : ${element.emp_id}</span>
            <input type="hidden" name="user_id[]" value="${element.user_id}">
            `);
                });
            }
        }
    }

    $('.main-input').change(function () {
        let checkbox = $(this).attr('id');
        if ($(this).is(":checked")) {
            $(`.${checkbox}`).prop('checked', true);
        } else {
            $(`.${checkbox}`).prop('checked', false);
        }
    });

    $('.sub-input').change(function () {
        let checkbox = $(this).attr('id');
        if ($(this).is(":checked")) {
            $(`.${checkbox}`).prop('checked', true);
        } else {
            $(`.${checkbox}`).prop('checked', false);
        }
        //check all sub check;
        let all_sub_input = $('.sub-input');
        let num_sub = 0;
        let checkbox_main = all_sub_input.attr('main-input');
        all_sub_input.each(function () {
            if ($(this).is(":checked")) {
                num_sub++;
            }
            if(num_sub == all_sub_input.length){
                $(`#${checkbox_main}`).prop('checked', true);
            }
        });
    });




    

    $(function () {
        get_user_data();
        get_user_permission();
    });
</script>

@endsection