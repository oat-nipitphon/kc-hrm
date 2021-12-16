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
        <h5 class="card-title"><h3>รายชื่อสาขา</h3></h5>
        <div class="btn-group" role="group" aria-label="Basic example">
          <a class="btn btn-success"  href="{{ URL('warehouses/create') }}">เพิ่มสาขาสำนักงาน</a>              
        </div>
    </div>
    <div class="card-body">
      <div id="wrapper">
        <div class="col-6">
          <div class="card">
            <div class="card-body">
            
              <div class="table-responsive" style="margin-top:25px;">
                <table class="table table-sm" id="warehouses_table" style="width:100%;">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Line</th>
                      <th>Line token</th>
                      <th>สถานะ</th>
                      <th></th>
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
            [0, "asc"]
        ],
        "ajax": {
            "url": "/get-warehouses",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
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
                "data": "code",
            },
            {
                "data": "name",
            },
            {
                "data": "line_name",
            },
            {
                "data": "line_token",
            },
            {
                "data": "is_active",
                "render": function(data,type,full){
                    if(data == 1){
                        btn = '<span class="badge badge-primary">เปิดทำการ</span>';
                    }else{
                        btn = '<span class="badge badge-danger">ปิดทำการ</span>';
                    }
                    return btn;
                }
            },
            {
                "data": "id",
                "render":function(data,type,full){
                  return '<a href="/warehouses/'+data+'" class="btn btn-warning btn-sm">ดู</a>';
                }
            },
            
        ],
    });
</script>
@endsection
