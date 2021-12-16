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
    <div class="card-body" style="padding-top:15px;">
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
    <form id="form-check-employee" action="/check-employee-user" method="post">
        @csrf
        <div class="card-header">
            <div class="col-md-12 col-sm-12" style="padding-top:2rem;">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <h3 class="card-title">
                            <span>Employee</span>
                        </h3>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div id="wrapper">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive" style="margin-top:25px;">
                                <table class="table table-sm" id="employees-table" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th><label for="check-all"><input id="check-all" type="checkbox">
                                                    All</label></th>
                                            <th>รหัสพนักงาน</th>
                                            <th>ชื่อ - นามสกุล</th>
                                            <th>ตำแหน่ง</th>
                                            {{-- <th></th> --}}
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
    </form>
</div>


<div class="modal fade" id="show-username" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">รายละเอียด Username</h4>
        </div>
        <div class="modal-body">
            <table class="table table-lg" id="show-username-table" style="width:100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>เมื่อวันที่</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>


@endsection
@section('script')
<script>

    var password;
    var employees_table;
    function show_user_detail(data){
        let show_username_table = $('#show-username-table').DataTable({
        "info": true,        
        "searching": true,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": false,
        "destroy": true,
        "pageLength": 10000,
        "dom": 'Bfrtip',
        "buttons": [
            'excel'
        ],
        "order": [
            [0, "asc"]
        ],
        "data" : data,
        'columnDefs': [{
            "targets": 0,
            "className": "text-center",
            "orderable": false
        }, ],
        "columns": [ 
            {
                "data": "name",
            },
            {
                "data": "email",
            },
            {
                "data": "username",
            },
            {
                "render": function(data,type,full)
                {
                    return password;
                }
            },
            {
                "data": "created_at",
            },
           
        ],
    });
    }
    
function user_data (search_data){
    employees_table = $('#employees-table').DataTable({     
        "processing": true,
        "serverSide": true,   
        "info": true,        
        "searching": true,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": false,
        "destroy": true,
        "pageLength": 10000,
        "order": [
            [0, "asc"]
        ],
        "ajax": {
            "url": "/get-employees",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
                "is_permission": true,
                "search_data" : search_data,
            },
        },
        'columnDefs': [{
            "targets": 0,
            "className": "text-center",
            "orderable": false
        }, ],
        "columns": [ 
            {
                "data": "id",
                "render":function(data){
                    return `<input type="checkbox" value="${data}" name="emp_id[]" class="checkbox-all">`;
                }
            },
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
        ],
    });
}
    

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

$('#form-check-employee').submit(function (e) {
    const url = $(this).attr('action');
    let formData = $(this).serialize();
    e.preventDefault();
    Swal.fire({
        title: 'เพิ่ม Username?',
        text: "ต้องการจะเพิ่ม username หรือไม่",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ต้องการ',
        cancelButtonText: 'ไม่ต้องการ'
    }).then((result) => {
        if (result.value) {
           
            $.post(url, formData,
                function (res) {
                    swal.fire(res.title, res.msg, res.status).then(function () {
                        password = res.password;
                        employees_table.ajax.reload(null, false);
                        show_user_detail(res.data);
                        
                        (res.status == 'success') ? $('#show-username').modal('show'): false;
                    });
                },
            );
        }
    })
});

$('#search').click(function(){
    let search_data = {
        warehouse : $('#warehouse').val(),
        position : $('#position').val(),
        section : $('#section').val(),
        division : $('#division').val()
    }
    user_data(search_data);
});

$(function () {
    user_data(null);
});
</script>

@endsection