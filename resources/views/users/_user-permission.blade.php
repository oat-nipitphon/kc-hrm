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
        <h5 class="card-title">
            <h3>User permission</h3>
        </h5>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-success btn-position-modal" id="employee-modal-btn">เพิ่ม Username</a>
        </div>
    </div>
    <div class="card-body">
        <div id="wrapper">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive" style="margin-top:25px;">
                            <table class="table table-sm" id="user_permission_table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>ชื่อ</th>
                                        <th>Username</th>
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
    var user_permission_table = $('#user_permission_table').DataTable({
        "searching": true,
        "ordering": false,
        "info": false,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": true,
        "destroy": true,
        "pageLength": 25,
        // "order": [
        //     [0, "asc"]
        // ],
        "ajax": {
            "url": "/get-user-permissions",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
            },
        },
        'columnDefs': [{
            "targets": 0,
            "className": "text-center",
        }, ],
        "columns": [{
                "data": "id",
            },
            {
                "data": "name",
            },
            {
                "data": "username",
            },
            {
                "data": "id",
                "render": function (data) {
                    return '<button class="btn btn-sm btn-info" onclick="set_permission(' + data +
                        ')"><i class="fa fa-plus"></i> Permission</button>';
                }
            },
        ],
    });


    let employees_table = $('#employees-table').DataTable({     
        "processing": true,
        "serverSide": true,   
        "info": true,        
        "searching": true,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": true,
        "destroy": true,
        "pageLength": 25,
        "order": [
            [0, "asc"]
        ],
        "ajax": {
            "url": "/get-employees",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
            },
        },
        'columnDefs': [{
            "targets": 0,
            "className": "text-left",
        }, ],
        "columns": [ 
            {
                "data": "emp_id",
            },
            {               
                "data": "th_firstname",                
                "render":function(data,type,full){
                  return `${full.th_firstname} ${full.th_lastname}`;
                }
            },
            {
                "data": "emp_position.warehouse_position.get_warehouse.name",
                "render":function(data,type,full){
                  var res = (full.emp_position) ? data : '-';
                  return res;
                }
            },
            {
                "data": "emp_position.warehouse_position.get_position.name",
                "render":function(data,type,full){
                  var res = (full.emp_position) ? data : '-';
                  return res;
                }
            },
            {
                "data": "emp_position.warehouse_position.get_position.get_section.name",
                "render":function(data,type,full){
                  var res = (full.emp_position) ? data : '-';
                  return res;
                }
            },
            {
                "data": "emp_position.warehouse_position.get_position.get_section.get_division.name",
                "render":function(data,type,full){
                  var res = (full.emp_position) ? data : '-';
                  return res;
                }
            },
            {
                "data": "id",
                "render": function (data,type,full) {
                    return `<button class="btn btn-sm btn-info" onclick="add_username(`+ data +`,\``+ full.emp_id +`\`,\``+ full.th_firstname+` `+full.th_lastname +`\`)"><i class="fa fa-plus"></i> เพิ่ม Username</button>`;
                }
            },
        ],
    });

$('#employee-modal-btn').click(function(){
    employees_table.ajax.reload();
    $('#employee-modal').modal('show');
});

function add_username(id,emp_id,name){
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

</script>

@endsection