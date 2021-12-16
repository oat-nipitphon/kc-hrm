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
        {{-- <div class="btn-group" role="group">
            <a class="btn btn-success" id="create-calendar-modal" modal-action="create"><span class="fa fa-plus"></span> เพิ่มปฏิทินประจำปี</a>
        </div> --}}
    </div>
    <div class="card-body">
      <div class="table-responsive" style="margin-top:25px;">
        <table class="table table-sm table-responsive" id="announce_table" style="width:100%;">
          <thead>
            <tr>     
              <th>#</th>
              <th>รายการ</th>
              <th>ประเภท</th>
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
<div class="modal fade" id="email-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ข้อมูลปฏิทิน</h4>
      </div>
      <form id="announces-send-mail" action="/announces-send-mail" method="POST">
        @csrf
        <input type="hidden" name="calendar_event_id" id="calendar_event_id">
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">                
                    <div class="form-group" id="emp-email">
                    </div>
                    <div class="form-group">
                        <a href="javascript:void(0)" onclick="email_input(false)"
                            class="btn btn-warning btn-sm btn-block"><span class="fa fa-plus"></span> เพิ่มอีเมล</a>
                    </div>
                </div>
                <div class="col-md-8">
                    @include('email-templates.annual-holiday')
                </div>
            </div> 
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
            <button type="submit" id="save-calendar" class="btn btn-primary">ส่ง</button>
        </div>
    </form>
    </div>
  </div>
</div>


@endsection
@section('script')
<script>
    const input_email = () => {return $('<input>')
                                        .attr('type','email')
                                        .addClass('form-control')
                                        .attr('name','emp_email[]')
                                        .attr('placeholder','email')
                                        .attr('style','margin-bottom:5px;');
                            }
    var email_list_modal = (calendar_event_id,check) => {
        $('#calendar_event_id').val(calendar_event_id);
        email_input(check);
        let email_content = $('#email-contents');
        $.post("/find-event-announces", data = {
            id : calendar_event_id,
            _token: '{{ csrf_token() }}',
        },
            function (res) {
                let events = JSON.parse(res.options);
                $.each(events, function (index, value) {
                    let no = index+1;
                    $('#email-contents').append(`
                        <tr>
                            <td style="border: 1px solid black;border-collapse: collapse;text-align: center;">` + no +`</td>
                            <td style="border: 1px solid black;border-collapse: collapse;text-align: center;">` + value.start +`</td>
                            <td style="border: 1px solid black;border-collapse: collapse;text-align: center;">` + value.title +`</td>
                        </tr>
                    `); 
                });
                
            },
        );
        $('#email-modal').modal('show');
    }

    var email_input = (check) => {
        let email_input = $('#emp-email');
        if(check){
            email_input.empty();
            email_input.append($('<label></label>').text('Email'));
        }
        email_input.append(input_email());
    }

    // $(this).serialize()
    $('#announces-send-mail').submit(function (e) {
        e.preventDefault();
        let form = $(this).serialize();
        let url = $(this).attr('action');
        $.ajax({
            type: "method",
            method: "POST",
            url: url,
            data: form,
            success: function (res) {
                swal.fire(res.title, res.msg, res.status).then(function () {                    
                    (res.status == 'success') ? $('#email-modal').modal('hide'): true;
                });
            }
        });
    });
    
    let announce_table = $('#announce_table').DataTable({
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
            "url": "/get-announces",
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
                "data": "type",
            },
            {
                "data": "calendar_event_id",
                "render":function(data){
                  return `
                    <a href="javascript:void(0)" onclick="email_list_modal(`+data+`,`+true+`)" class="btn btn-sm btn-primary"><i class="fa fa-paper-plane"></i> ส่งอีเมล</a>
                  `;
                }
            },
        ],
    });

    announce_table.on( 'order.dt search.dt', function () {
      announce_table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    
</script>

@endsection
