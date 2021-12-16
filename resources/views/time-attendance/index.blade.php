@extends('layouts.app')

@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
  {{--<li>--}}
    {{--<a href="{{index.html}}">หน้าหลัก</a>--}}
  {{--</li>--}}
  <li class="active">
    <strong>หน้าหลัก</strong>
  </li>
</ol>
@endsection

@section('content')

  <div class="row wrapper border-bottom white-bg page-heading">

    <div class="card-header">
        <h5 class="card-title"><h3>ประวัติการสแกนนิ้วเข้างาน </h3></h5>
        {{-- <div class="btn-group" role="group" aria-label="Basic example">
          <a class="btn btn-success"  href="{{ URL('warehouses/create') }}">เพิ่มสาขาสำนักงาน</a>              
        </div> --}}
    </div>
    <div class="card-body">
      <div id="wrapper">
        <div class="col-6">
          <div class="card">
            <div class="card-body">
            
              <div class="table-responsive" style="margin-top:25px;">
                <table class="table table-sm table-striped" id="warehouses_table" style="width:100%;">
                  <thead>
                    <tr>
                      <th>รหัสพนักงาน</th>
                      <th>ชื่อ - นามสกุล</th>
                      <th>ตำแหน่ง</th>
                      <th>รหัสเครื่องสแกนนิ้ว</th>
                      <th>เวลาสแกนนิ้วมือ</th>
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

@endsection
@section('script')
<script>
     test = () => {
            $.get("/times.json", data = null,
            function (res) {
                let data = res;
                // $.post("/dev", data = {
                //   times : JSON.stringify(res),
                //   _token: '{{ csrf_token() }}',
                // },
                //   function (res) {
                //     console.log(res);
                //   },
                // );
                datatab(data);
            },
            "json"
        );
    }

    datatab = (data) => {
        let warehouses_table = $('#warehouses_table').DataTable({
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
            [4, "desc"]
        ],
        // "data" : data,
        "ajax": {
            "url": "/dev-getatt",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
            },
        },
        // 'columnDefs': [{
        //     "targets": 0,
        //     "className": "text-center",
        // }, ],
        "columns": [
            {
                "data": "employee_log",
                "render":function(data,type,full){
                  if(data){
                    return `${full.employee_log.emp_id}`;
                  }else{
                    return '-';
                  }
               
                }
            },
            {
                "data": "employee_log",
                "render":function(data,type,full){
                  if(data){
                    return `${full.employee_log.th_firstname} ${full.employee_log.th_lastname}`;
                  }else{
                    return '-';
                  }
               
                }
            },
            {
              "data": "employee_log",
              "render": function (data) {
                var html = [];
                if(data){
                  var userData = data.emp_position;
                  userData.forEach(element => {
                  let position =`
                  <ul style="margin-bottom:0px;list-style-type:none;padding-left:0px;">
                    <li>สาขา : ${element.warehouse_position.get_warehouse.name}</li>
                    <li>ตำแหน่ง : ${element.warehouse_position.get_position.name}</li>
                    <li>แผนก : ${element.warehouse_position.get_position.get_section.name}</li>
                  </ul>`;
                  html.push(position);
                });
                return html;
                }else{
                  return '-';
                }
                
              }
            },
            {
                "data": "userSn",
            },          
            {
                "data": "recordTime",
                "render":function(data){
                  return moment(data).format('YYYY-MM-DD HH:mm');
                }
            },
        ],
    });
    }

    $(function () {
        // test();
        datatab();
    });


  
</script>
@endsection
