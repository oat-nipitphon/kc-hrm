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

    <div class="card-header"></div>

    <div class="card-body">
      <div id="wrapper">

        <div class="col-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><h3>รายชื่อพนักงาน</h3></h5>          
                <a class="btn btn-success"  href="{{ URL('employees/create') }}">เพิ่มพนักงาน</a>              
                <a class="btn btn-primary"  href="/employees/upload-excel">เพิ่มพนักงาน Excel</a>          
              {{-- <div class="table-responsive">
                <table class="table table-sm" >
                  <thead>
                    <tr>
                      <th scope="col">สถานะ</th>
                      <th>รหัสพนักงาน</th>
                      <th>ชื่อ</th>
                      <th>นามสกุล</th>
                      <th>Name</th>
                      <th>Lastname</th>
                      <th>เพศ</th>
                      <th>Username</th>
                      <th>รายละเอียด</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($employees as $employee)
                    <tr>
                      <td>{{($employee->active_name)}}</td>
                      <td>{{($employee->emp_id)}}</td>
                      <td>{{$employee->th_firstname}}</td>
                      <td>{{$employee->th_lastname}}</td>
                      <td>{{$employee->en_firstname}}</td>
                      <td>{{$employee->en_lastname}}</td>
                      <td>{{$employee->sex_name}}</td>
                      @isset($employee->user->name)
                      <td>{{$employee->user->name}}</td>
                      @endisset
                      @empty($employee->user->name)
                      <td>{{$employee->user_id}}</td>
                      @endempty
                      <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <a class="btn btn-warning" href="{{ route('employees.show',$employee->id) }}">ดู</a>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                  {{$employees->links()}}
              </div> --}}

              <div class="table-responsive" style="margin-top:25px;">
                <table class="table table-sm table-responsive table-striped" id="employees-table" style="width:100%;">
                  <thead>
                    <tr>
                      <th>สถานะ</th>
                      <th>รหัสพนักงาน</th>
                      <th>ประเภทพนักงาน</th>
                      <th>ชื่อ - นามสกุล</th>
                      {{-- <th>สาขา</th>                    --}}
                      <th>ตำแหน่ง</th>
                      {{-- <th>แผนก</th>
                      <th>ฝ่ายงาน</th> --}}
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

@endsection
@section('script')
<script>
      $('#employees-table').DataTable({
        "info": true,        
        "searching": true,
        "responsive": true,
        "Filter": true,
        "LengthChange": true,
        "destroy": true,
        "pageLength": 25,
        "lengthMenu": [
          [10, 25, 50, -1],
          ['10', '25', '50', 'All']
        ],
        "dom": 'Bfrtip',
        "buttons": [
          'excel','pageLength'
        ],
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
              "data": "is_active",
              "render":function(data){
                if(data == 1){
                  return '<span class="badge badge-info">ทำงาน</span>';
                }else{
                  return '<span class="badge badge-danger">สิ้นสุดการทำงาน</span>';
                }
              }
            },   
            {
                "data": "emp_id",
            },
            {
                "data": "emp_type.name",
            },
            {
                "data": "th_firstname",
                "render":function(data,type,full){
                  return `${full.title_name.name} ${full.th_firstname} ${full.th_lastname}`;
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
            {
                "data": "id",
                "render":function(data){
                  return `
                      <a href="/employees/${data}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i> ดูข้อมูล</a>
                      <a href="/employees/${data}/edit" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> แก้ไข</a>
                 `;
                }
            },
        ],
    });

   

</script>
@endsection
