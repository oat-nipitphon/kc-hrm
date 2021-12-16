@extends('layouts.app')
@section('breadcrumb')

<h2>สร้างสาขาใหม่</h2>
<ol class="breadcrumb">
  <li>
    <a href="#">หน้าหลัก</a>
  </li>
  <li>
    <a href="{{ route('warehouses.index') }}">จัดการสาขา</a>
  </li>
  <li class="active">
    <strong>สร้างสาขาใหม่</strong></a>
  </li>
</ol>

@endsection

@section('content')

<div class="panel panel-default" style="border:none!important;">
  <form class="form-horizontal" action="{{route('warehouses.store')}}" method="POST">
    @csrf
    <div class="panel-body">
      <div class="col-12">
        <h5>สร้างสาขาใหม่</h5>
      </div>
      <div class="col-12">
        <a href="{{ route('warehouses.edit',$warehouse->id) }}" class="btn btn-primary"><i class="fa fa-save"></i> แก้ไข</a>
        <a href="{{ route('warehouses.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i> ย้อนกลับ</a>
      </div>
    </div>

    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active">
        <a href="#warehouse-view" aria-controls="warehouse-view" role="tab" data-toggle="tab"
          aria-expanded="true">ข้อมูลสาขา</a>
      </li>
      <li role="presentation">
        <a href="#warehouse-position" aria-controls="warehouse-position" role="tab" data-toggle="tab">ตำแหน่งงาน</a>
      </li>     
      <li role="presentation">
        <a href="#warehouse-employee" aria-controls="warehouse-employee" role="tab" data-toggle="tab">พนักงาน</a>
      </li>
      <li role="presentation">
        <a href="#warehouse-manpower" aria-controls="warehouse-manpower" role="tab" data-toggle="tab">อัตรากำลังคน</a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="warehouse-view">
        @include('warehouses.contents.warehouse-profile')
      </div>
      <div role="tabpanel" class="tab-pane" id="warehouse-position">
        @include('warehouses.contents.warehouse-position')
      </div>
      <div role="tabpanel" class="tab-pane" id="warehouse-employee">
        @include('warehouses.contents.warehouse-employee')
      </div>
      <div role="tabpanel" class="tab-pane" id="warehouse-manpower">
        @include('warehouses.contents.warehouse-manpower')
      </div>
    </div>
  </form>
</div>
@endsection
@section('script')
<script>
      var emp_id = '';
       let warehouses_position_table = $('#warehouses_position_table').DataTable({
        "ordering": true,
        "bPaginate": true,
        "searching": true,
        "info": false,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": true,
        "destroy": true,
        "pageLength": 50,
        "order": [
            [0, "asc"]
        ],
        "ajax": {
            "url": "/get-warehouses-position",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
                "id": "{{ $id }}"
            },
        },
        'columnDefs': [{
            "targets": 0,
            "className": "text-center",
        }, ],
        "columns": [
            {
                "data": "id",
            },            
            {
                "data": "position_name",
            },
            {
                "data": "section_name",
            },
            {
                "data": "division_name",
            },        
        ],
    });

    $('#position-emp-create').click(function(){
        $('#position-emp-modal').modal('show');
        getPosition();
    });


function getPosition(){
  $('#w_position_table').DataTable({        
        "info": false,        
        "searching": true,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": true,
        "destroy": true,
        "pageLength": 15,
        "order": [
            [0, "asc"]
        ],
        "ajax": {
            "url": "/warehouses-position",
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
                "data": "position_name",
                "render":function(data){
                  return '<strong>'+ data +'</strong>';
                }
            },
            {
                "data": "section_name",
            },
            {
                "data": "division_name",
            },
            {
                "data": "id",
                "render":function(data){
                  return '<a href="javascript:void(0)" onclick="warehouse_add_position('+ data +')"><span class="badge badge-info">เลือก</span></a>';
                }
            },            
        ],
    });
  }


  var employee_table = $('#w-employee-table').DataTable({        
        "info": false,        
        "searching": true,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": true,
        "destroy": true,
        "pageLength": 15,
        "order": [
            [0, "asc"]
        ],
        "ajax": {
            "url": "/warehouses-employees",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
                "id": "{{ $id }}"
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
                "render":function(data,type,full){
                  return '<span>'+ full.th_firstname + ' '+ full.th_lastname +'</span>';
                }
            },    
            {
                "data": "position_name",
                "render":function(data){
                  return '<strong>'+ data +'</strong>';
                }
            },           
            {
                "data": "section_name",
            },
            {
                "data": "division_name",
            },          
        ],
    });


    function getEmp(){
      $('#w-add-employee-table').DataTable({        
        "info": false,        
        "searching": true,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": true,
        "destroy": true,
        "pageLength": 10,
        "order": [
            [0, "asc"]
        ],
        "ajax": {
            "url": "/warehouses-employees-add",
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
                "render":function(data,type,full){
                  return '<span>'+ full.th_firstname + ' '+ full.th_lastname +'</span>';
                }
            },  
            {
                "data": "id",
                "render":function(data){
                  return '<a href="javascript:void(0)" onclick="get_emp_position('+ data +')"><span class="badge badge-info">เพิ่มเข้าสาขา</span></a>';
                }
            },
                      
        ],
    });
  }

$('#warehouse-add-emp').click(function(){
  $('#warehouse-emp-modal').modal('show');
  getEmp();
})

function get_emp_position(id){
  emp_id = id;
  $('#warehouse_posision_employee_table').DataTable({
        "ordering": true,
        "bPaginate": true,
        "searching": true,
        "info": false,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": true,
        "destroy": true,
        "pageLength": 50,
        "order": [
            [0, "asc"]
        ],
        "ajax": {
            "url": "/get-warehouses-position",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
                "id": "{{ $id }}"
            },
        },
        'columnDefs': [{
            "targets": 0,
            "className": "text-left",
        }, ],
        "columns": [          
            {
                "data": "position_name",
            },
            {
                "data": "section_name",
            },
            {
                "data": "division_name",
            },     
            {
                "data": "id",
                "render":function(data){
                  return '<a href="javascript:void(0)" onclick="save_position_emp('+data+')"><span class="badge badge-info">เพิ่ม</span></a>';
                }
            },   
        ],
    });
  $('#warehouse-position-emp-modal').modal('show');
}

function save_position_emp(warehouses_position_id){
  Swal.fire({
    title: 'Alert',
    text: "ต้องการจะเพิ่มข้อมูลหรือไม่",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'ตกลง',
    cancelButtonColor: '#d33',
    cancelButtonText: 'ยกเลิก',
  }).then((result) => {
    if (result.value) {
        $.post("/warehouses-employees-save", data = {
          "warehouses_position_id": warehouses_position_id,
          "emp_id": emp_id,          
          _token: '{{ csrf_token() }}'
        },
          function (res) {
              swal.fire(res.title,res.msg,res.status);
              $('#warehouse-position-emp-modal').modal('hide');
              getEmp();
              employee_table.ajax.reload(null,false);
              manpower_table.ajax.reload(null,false);
          },
        );
    }
  })
}

function warehouse_add_position(position_id){
  Swal.fire({
    title: 'Alert',
    text: "ต้องการจะเพิ่มข้อมูลหรือไม่",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    confirmButtonText: 'ตกลง',
    cancelButtonColor: '#d33',
    cancelButtonText: 'ยกเลิก',
  }).then((result) => {
    if (result.value) {
        $.post("/warehouse-add-position", data = {
          "warehouse_id": "{{ $id }}",
          "position_id": position_id,
          _token: '{{ csrf_token() }}'
        },
          function (res) {
              swal.fire(res.title,res.msg,res.status);
              warehouses_position_table.ajax.reload(null,false);
          },
        );
    }
  })
}

var manpower_table = $('#w-manpower-table').DataTable({        
        "info": false,        
        "searching": true,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": true,
        "destroy": true,
        "pageLength": 10,
        "order": [
            [0, "asc"]
        ],
        "ajax": {
            "url": "/warehouses-manpower",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
                "id": "{{ $id }}"
            },
        },
        'columnDefs': [{
            "targets": 0,
            "className": "text-left",
        }, ],
        "columns": [     
            {
                "data": "position_name",
            },  
            {
                "data": "section_name",
            },   
            {
                "data": "division_name",
            },
            {
                "data": "count_manpower",
            },
            {
                "data": "manpower",
            },
            {
                "data": "id",
                "render": function(data,type,full){
                  return '<a class="badge badge-info" onclick="view_manpower('+ full.manpower +','+ data +')" href="javascript:void()">แก้ไข</a>';
                }
            },
                      
        ],
    });

    let wearhouse_position_id = '';
    function view_manpower(manpower,id){
      wearhouse_position_id = id;
      $('#manpower-value').val(manpower);
      $('#manpower-emp-modal').modal('show');
    }

    $('#save-manpower').click(function(){
      $.post("/save-manpower", data = {
        id:wearhouse_position_id,
        manpower:$('#manpower-value').val(),
        _token: '{{ csrf_token() }}',
      },
        function (res) {
          swal.fire(res.title,res.msg,res.status).then(function(){
            manpower_table.ajax.reload(null,false);
            $('#manpower-emp-modal').modal('hide');
          });         
        },
      );
    });

 
</script>
@endsection