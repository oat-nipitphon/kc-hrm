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
              <div class="table-responsive" style="margin-top:25px;">
                <table class="table table-sm table-responsive table-striped" id="employees-table" style="width:100%;">
                  <thead>
                    <tr>
                      <th>รหัสพนักงาน</th>
                      <th>ประเภทพนักงาน</th>
                      <th>ชื่อ - นามสกุล</th>
                      <th>ลาป่วย(ใบรับรองแพทย์)</th>
                      <th>ลากิจ</th>
                      <th>ลาคลอด</th>
                      <th>ลาบวช</th>
                      <th>ลาพักร้อน</th>
                      <th>ออกนอกสถานที่</th>
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
                "data": "la1",
            },
            {
                "data": "la2",
            },
            {
                "data": "la3",
            },
            {
                "data": "la4",
            },
            {
                "data": "la5",
            },
            {
                "data": "la6",
            },
            
        ],
    });

   

</script>
@endsection
