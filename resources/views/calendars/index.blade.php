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
        <h5 class="card-title">
            <h3>ปฏิทินประจำปี</h3>
        </h5>
        <div class="btn-group" role="group">
            <a class="btn btn-success" id="create-calendar-modal" modal-action="create"><span class="fa fa-plus"></span> เพิ่มปฏิทินประจำปี</a>
        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive" style="margin-top:25px;">
        <table class="table table-sm table-responsive" id="calendar-table" style="width:100%;">
          <thead>
            <tr>     
              <th>#</th>
              <th>รายการ</th>
              <th>วันที่สร้างรายการ</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="calendar-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ข้อมูลปฏิทิน</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>ชื่อปฏิทิน</label>
            <input type="text" class="form-control" id="name" placeholder="ex ปฏิทินประจำปี 2563">
          </div>  
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="button" id="save-calendar" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
  </div>
</div>


@endsection
@section('script')
<script>
    $('#create-calendar-modal').click(function(){
      $('#calendar-modal').modal('show');
    });

    $('#save-calendar').click(function(){
        $.post("/create-calendar", data = {
          name : $('#name').val(),
          _token: '{{ csrf_token() }}'
        },
          function (res) {
            swal.fire(res.title, res.msg, res.status).then(function () {
              calendar_table.ajax.reload(null, false);
              (res.status == 'success') ?  $('#calendar-modal').modal('hide'): true;
            });
          },
        );
    });


    let calendar_table = $('#calendar-table').DataTable({
        "info": false,        
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
            "url": "/get-calendar",
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
                "data": null,
            },  
            {
                "data": "name",
            },
            {
                "data": "created_at",
            },
            {
                "data": "id",
                "render":function(data){
                  return `
                    <a href="/calendar-event/`+data+`" class="btn btn-sm btn-warning">ดูข้อมูล</a>
                    <a href="/calendar-event/`+data+`" class="btn btn-sm btn-danger">ลบข้อมูล</a>
                  `;
                }
            },
        ],
    });

    calendar_table.on( 'order.dt search.dt', function () {
      calendar_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
</script>

@endsection
