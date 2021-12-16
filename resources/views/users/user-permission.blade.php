@extends('layouts.app')
<style>
    .type-none {
        list-style-type: none;padding-left:5px;
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
      <h3>ค้นหาข้อมูลพนักงาน</h3>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>สาขา</label>
                        <select id="warehouse" class="form-control selectpicker" data-live-search="true">
                            <option value="">ทั้งหมด</option>
                            @foreach ($warehouses as $warehouse)
                            <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                            @endforeach                            
                        </select>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>ตำแหน่ง</label>
                        <select id="position" class="form-control selectpicker" data-live-search="true">
                            <option value="">ทั้งหมด</option>
                            @foreach ($positions as $position)
                            <option value="{{$position->id}}">{{$position->name}}</option>
                            @endforeach                            
                        </select>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>แผนก</label>
                        <select id="section" class="form-control selectpicker" data-live-search="true">
                            <option value="0">ทั้งหมด</option>
                            @foreach ($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}}</option>
                            @endforeach 
                        </select>
                      </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>ฝ่ายงาน</label>
                        <select id="division" class="form-control selectpicker" data-live-search="true">
                            <option value="0">ทั้งหมด</option>
                            @foreach ($divisions as $division)
                            <option value="{{$division->id}}">{{$division->name}}</option>
                            @endforeach 
                        </select>
                      </div>
                </div>
            </div>
            <div class="row text-center">
                <button class="btn btn-info" id="search"><i class="fas fa-search"></i> ค้นหา</button>
            </div>
        </div>
    </div>
    <div class="card-header">
        <div class="col-md-12">
            <hr> 
        </div>             
    </div>
    <div class="card-header">
        <h3 class="card-title">
            User permission
        </h3>
            <a href="{{route('user-create-page')}}" target="_blank" class="btn btn-success btn-position-modal" id="employee-modal-btn">เพิ่ม Username</a>
            <a href="javascript:void(0)" onclick="user_to_permission()" class="btn btn-warning btn-position-modal" id="employee-modal-btn">จัดการ Permission</a>
    
    </div>
    <div class="card-body">
        <div id="wrapper">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" style="margin-top:25px;">
                            <table class="table table-sm table-striped" id="user_permission_table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th><label for="check-all"><input id="check-all" type="checkbox"></label></th>
                                        <th>รหัสพนักงาน</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        {{-- <th>สาขา</th>                    --}}
                                        <th>ตำแหน่ง</th>
                                        {{-- <th>แผนก</th> --}}
                                        {{-- <th>ฝ่ายงาน</th> --}}
                                        <th>จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="employee-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <table class="table table-sm" id="employees-table" style="width:100%;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th>ชื่อ - นามสกุล</th>
                            <th>สาขา</th>
                            <th>ตำแหน่ง</th>
                            <th>แผนก</th>
                            <th>ฝ่าย</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <button type="button" id="submit" class="btn btn-primary">บันทึก</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="save-username-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">เพิ่ม User</h4>
            </div>
            <form action="/create-employee-user" id="form-save-user" method="post">
                @csrf
                <div class="modal-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#user-tab" aria-controls="user-tab" role="tab" data-toggle="tab"
                                aria-expanded="true"><i class="fa fa-user"></i> User</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="user-tab">
                            <input type="hidden" id="employee-id" name="employee_id">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" class="form-control" name="password" id="password">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                    <button type="submit" id="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="permission-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Permissions</h4>
            </div>
            <form action="/save-user-permission" id="form-user-permission" method="post">
                @csrf
                <input type="hidden" id="this-user-id" name="user_id">
                <div class="modal-body row" id="permission-lists">
                    {{-- for roles --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                    <button type="submit" id="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
@section('script')
<script>
    var employee_id;
    var user_permission_table;
    
    user_permission = (search_data)=>{
        user_permission_table = $('#user_permission_table').DataTable({
        "searching": true,
        "ordering": false,
        "info": false,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": true,
        "destroy": true,
        "pageLength": 25,
        "ajax": {
            "url": "/get-user-permissions",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
                "search_data" : search_data
            },
        },
        'columnDefs': [{
            "targets": 0,
            "className": "text-center",
        }, ],
        "columns": [
            {
                "data": "emp_user.id",
                "render":function(data,type,full){
                    return `<input type="checkbox" user_name="${full.emp_user.name}" user_id="${data}" emp_id="${full.emp_id}" class="checkbox-all">`;
                }
            },
            {
                "data": "emp_id",
            },
            {
                "data": "emp_user.name",
            },
            {
                "data": "emp_user.username",
            },
            {
                "data": "emp_user.email",
            },           
            {
              "data": "emp_position",
              "render": function (data) {
                var html = [];
                data.forEach(element => {
                  let position =`
                  <ul style="margin-bottom:0px;list-style-type:none;padding-left:0px;">
                    <li>สาขา : ${element.warehouse_position.get_warehouse.name}</li>
                    <li>ตำแหน่ง : ${element.warehouse_position.get_position.name}</li>
                    <li>แผนก : ${element.warehouse_position.get_position.get_section.name}</li>
                  </ul>`;
                  html.push(position);
                });
                return html;
              }
            },
            {
                "data": "emp_user.id",
                "render": function(data){
                    return `<a href="/manage-permission-user/${data}" class="btn btn-warning btn-sm">แก้ไข Permission</a>`;
                }
            },
        ],
    });
    }


add_username = (id,emp_id,name) =>{
    $('#employee-id').val(id);
    $('#employee-modal').modal('hide');
    $('#password').val('');
    let email = emp_id +'@kcmetalsheet.com';
    let username = emp_id;
    $('#email').val(email);
    $('#username').val(emp_id);
    $('#name').val(name);
    $('#save-username-modal').modal('show');
}

$('#save-username-modal').on('hide.bs.modal', function () {
    $('#employee-modal').modal('show');
});

$('#form-save-user').submit(function(e){
e.preventDefault();
    let formData = $(this).serialize();
    const url = $(this).attr('action');
    $.post(url, formData,
        function (res) {
            swal.fire(res.title, res.msg, res.status).then(function(){
                user_permission_table.ajax.reload(null, false);
                employees_table.ajax.reload(null, false);
                (res.status == 'success') ? $('#save-username-modal').modal('hide'): true;
                $('#employees-table_filter').find('input').val('').keydown();
            }); 
        },
    );
});

set_permission = (user_id) => {
    $.post("/get-permissions", data = {
        _token: '{{ csrf_token() }}',
        user_id: user_id
    },
        function (res) {
            $('#this-user-id').val(user_id);
            let pers = $('#permission-lists');
            pers.empty();
                res.permissions.forEach(element => {
                    let roles = element.permission;
                    pers.append(
                        $('<div class="col-md-6 col-sm-6"></div>')
                        .append($('<div></div>').addClass('checkbox').append($(`<strong>${element.group_name}</strong>`))
                            .append($(`<ul id="pers-ul-${element.id}"></ul>`).addClass('type-none'))));
                    let pers_ul = $(`#pers-ul-${element.id}`);
                    roles.forEach(role => {
                        var checked_role = false;
                        res.permission_user.forEach(perm_user => {
                            if(perm_user.permission_id == role.id){
                                checked_role = true;
                            }
                        });
                        pers_ul.append($('<li></li>')
                            .append($('<label></label>')
                                .append($('<input>')
                                    .attr('type', 'checkbox').val(`${role.id}`).attr('name', `permission[]`).prop('checked', checked_role)
                                ).append($('<span></span>').text(`${role.description}`))
                            )
                        )
                    });
                });
            $('#permission-modal').modal('show');
        },
    );
}

$('#form-user-permission').submit(function(e){
    e.preventDefault();
    const url = $(this).attr('action');
    const formData = $(this).serialize();
    $.post(url, formData,
        function (res) {
            console.log(res);
        },
    );
});

$('table > thead > tr > th > label > input#check-all').click(function(){   
    if($(this).is(":checked")){
        $('.checkbox-all').prop('checked',true);
    }else{
        $('.checkbox-all').prop('checked',false);
    }
});



$('table > tbody').click(function(){
    let count = 0;
    let checkbox = $(this).children().find('input.checkbox-all');
    checkbox.each(function() {
        if($(this).is(":checked")){
            count += 1;
        }else{
            $('#check-all').prop('checked',false);
            return false;
        }
    });
    if(count == checkbox.length){
            $('#check-all').prop('checked',true);
    }
});


user_to_permission = () =>{
    let user_data = [];
    let checkbox = $('table > tbody').children().find('input.checkbox-all');
    checkbox.each(function() {
        if($(this).is(":checked")){
            let user = {
                user_id : $(this).attr('user_id'),
                emp_id : $(this).attr('emp_id'),
                user_name: $(this).attr('user_name')
            }
            user_data.push(user);
        }
    });
    if(user_data == ''){
        swal.fire('Alert','กรุณาเลือก Username ที่ต้องการ','warning');
        return false;
    }
    localStorage.setItem("user-permissions", JSON.stringify(user_data));
    window.location.replace('{{route("manage permissions user")}}');
    // window.open('{{route("manage permissions user")}}');
}

$('#search').click(function(){
    let search_data = {
        warehouse : $('#warehouse').val(),
        position : $('#position').val(),
        section : $('#section').val(),
        division : $('#division').val()
    }
    user_permission(search_data);
});

//for jq ready
$(function () {
    user_permission(null);
});
</script>

@endsection