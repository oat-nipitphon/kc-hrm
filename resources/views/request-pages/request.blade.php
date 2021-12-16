@extends('layouts.app')

@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
    <li class="active">
        <strong>หน้าหลัก</strong>
    </li>
</ol>
@endsection

@section('content')

{{-- <div class="row wrapper border-bottom white-bg page-heading" style="margin-bottom:15px;">
    <div class="card-header">
        <h5 class="card-title">
            <h3>ตั้งค่า OT</h3>
        </h5>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-success btn-work-time-modal" modal-action="create"><i class="fas fa-plus"></i>  เพิ่มข้อมูล</a>
        </div>
    </div>
   
</div> --}}
<div class="row wrapper border-bottom white-bg page-heading" style="padding:15px;margin-bottom:15px;">
    <div class="card-body">
        <div id="wrapper">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <button actions='OT-pages' class="btn btn-lg btn-primary">
                        <i class="fas fa-user-clock"></i> ทำเรื่องขอ OT
                    </button>
                    <button actions='leave-pages' class="btn btn-lg btn-primary">
                        <i class="fas fa-clock"></i> ทำเรื่อง ลา/ขอออกนอกสถานที่
                    </button>
                    <button actions='leave-history' class="btn btn-lg btn-primary">
                        <i class="fas fa-clock"></i> ประวัติการขอ
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<form action="/request-work-time/save-request" id="form-request-work-time" enctype="multipart/form-data" method="post">
   <input type="hidden" name="check" id="check" value=''>
    <section id="pages">
      
    </section>
    
</form>




@endsection
@section('script')
<script>
    var emp_collection = [];
    var empx_table;
    var xText = '';
   $('button').click(function(e){
    page_loading('start');
        (async () => {
            let actions = $(this).attr('actions');
            let pages = $('#pages');
            res = '/request-work-time/pages/ot-page'
           

            if(actions == 'OT-pages'){
                xText = 'ขอ OT'
                data_url = '/get-worktime-ot';
                res = '/request-work-time/pages/ot-page'
                $('#check').val('OT');
            }else if(actions == 'leave-pages'){
                xText = 'ลา - ออกนอกสถานที่'
                res = '/request-work-time/pages/ot-page'
                data_url = '/get-worktime-leave';
                $('#check').val('Leave');
            }else{
                res = '/request-work-time/pages/history'
                data_url = '/get-worktime-leave';
            }
             await pages.load(res);
            
            await (get_ot = () => {
            if(actions = 'leave-history')
            $.post(data_url, data = {
                _token : '{{ csrf_token() }}'
            },
            function (res) {
                    let data = res.data;
                    let otList = $('#ot-list');
                    data.forEach(element => {
                        otList.append(`<option value="${element.id}">${element.name}</option>`);
                    });
                },
            ).done(function(){
                employee_datatable();
            });

        })();

        })().then(function(){
            page_loading('force-stop');            
        })
   });

   employee_datatable = () => {
    empx_table = $('#employees-table').DataTable({
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
                "render":function(data,type,full){
                    var html = '';
                    if(emp_collection.length == 0){
                        html = `
                                <a href="javascript:void(0)" onclick="get_employee_list(${full.id},'${full.emp_id}','${full.th_firstname} ${full.th_lastname}')" class="btn btn-block btn-primary choose-employee">เลือก</a>
                            `;
                    }else{
                        var y = 0;
                        emp_collection.forEach(element => {
                        
                        if(element == full.id){
                            y -= emp_collection.length;                           
                        }else{
                            y += 1;                            
                        }
                        if(emp_collection.length == y){
                            html = `
                                <a href="javascript:void(0)" onclick="get_employee_list(${full.id},'${full.emp_id}','${full.th_firstname} ${full.th_lastname}')" class="btn btn-block btn-primary choose-employee">เลือก</a>
                            `;
                        }else{
                            html = `
                                <a href="javascript:void(0)" class="btn btn-block btn-primary disabled choose-employee">เลือกเรียบร้อย</a>
                            `;
                        }
                    });
                    }               
                    return html;
                }
            },
        ],
    });
   }

    get_employee_list = (id, emp_id, name) => {
        emp_collection.push(id);
        let html = `<tr>
                        <td>${emp_id}</td>
                        <td>${name}</td>                   
                    </tr>
                    <input type="hidden" name="employee_id[]" value="${id}">
                    `;
                    
        $('#employees-list').append(html);
        empx_table.ajax.reload(false, null);
    }

    rem_employee = () => {
        emp_collection = [];
        empx_table.ajax.reload(false, null);
        $('#employees-list').empty();
    }

    $('#form-request-work-time').submit(function(e){
        e.preventDefault();
        let formData = new FormData(this);
        let url = $(this).attr('action');
        $.ajax({
            method: "POST",
            url: url,
            contentType: false,
            processData: false,
            data: formData,
            success: function (res) {
                if(res){
                    swal.fire('Success','บันทึกข้อมูลสำเร็จ','success').then((result) => {
                        location.reload();
                    })
                }
            }
        });
    });






   
</script>
@endsection