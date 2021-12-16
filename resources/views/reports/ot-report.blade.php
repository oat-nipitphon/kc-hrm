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

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="card-header">
        <h5 class="card-title">
            <h3>รายงาน</h3>
        </h5>
    </div>
    <div class="card-body">
        <div id="wrapper">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12 col-sm-12" style="padding-top:15px;">
                            <div class="row">
                                <div class="col-md-12" style="padding-top:15px;">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label>เลือกรายงาน</label>
                                            <select class="form-control" id="report-id">
                                                <option value="OT">รายงาน OT</option>
                                                <option value="Leave">รายงาน ออกนอกพื้นที่</option>
                                            </select>
                                        </div> 
                                        <div class="col-md-4">
                                            <label>เลือกประเภทรายงาน</label>
                                            <select class="form-control" id="report-status">
                                                <option value="approved">อนุมัติเรียบร้อย</option>
                                                <option value="unapproved">ไม่ผ่านการอนุมัติ</option>
                                                <option value="waiting">รอตรวจสอบ</option>
                                                <option value="all">ทั้งหมด</option>
                                            </select>
                                        </div>                                      
                                    </div>
                                </div>

                                <div class="col-md-12" style="padding-top:15px;">
                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <label>เลือกรูปแบบรายงาน (รายวัน เดือน ปี)</label>
                                            <select class="form-control" id="chage-date-type">
                                                <option value="dmy">วัน/เดือน/ปี</option>
                                                <option value="my">เดือน/ปี</option>
                                                <option value="year">ปี</option>
                                                <option value="all">ทั้งหมด</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" id="input-date-start">
                                            <label>จาก</label>
                                            <input type="date" id="date-start" class="form-control">
                                        </div>  
                                        <div class="col-md-4" id="input-date-end">
                                            <label>ถึง</label>
                                            <input type="date" id="date-end" class="form-control">
                                        </div>                                    
                                    </div>
                                </div>
                                <div class="col-md-12 text-center" style="padding-top:15px;">
                                    <button class="btn btn-primary" id="search"><i class="fas fa-search"></i> ค้นหา</button>
                                </div>
                            </div>
                          <hr>
                        </div>
                        <div class="tab-content">
                            <div class="col-md-12 col-sm-12" style="padding-top:15px;">
                                
                                <table class="table table-sm table-striped" id="report_table" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th>ประเภท</th>
                                            <th>เวลาเริ่ม</th>
                                            <th>เวลาสิ้นสุด</th>
                                            <th>พนักงาน</th>
                                            <th>ผู้ขอ</th>
                                            <th>วันที่ทำรายการ</th>
                                            <th>หมายเหตุ</th>
                                            <th>สถานะ</th>
                                            <th>อนุมัติโดย</th>
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
</div>




@endsection
@section('script')
<script>
    var report_table = $('#report_table').DataTable();
    
       tables = (data) => {        
        report_table = $('#report_table').DataTable({
        "ordering": true,
        "bPaginate": true,
        "searching": true,
        "info": false,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": true,
        "destroy": true,
        "pageLength": 50,
        "ajax": {
            "url": "/report/request-work-time",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
                "status": data,
                "date_type": $('#chage-date-type').val(),
                "date_start": $('#date-start').val(),
                "date_end": $('#date-end').val(),
                "report_id": $('#report-id').val()
            },
        },
        "columns": [
            {
                "data": "id",
            },
            {
                "data": "request_type",
                "render":function(data){
                    return (data == 'OT') ? 'ขอ OT' : 'etc';
                }
            },
            {
                "data": "start_time",
            },
            {
                "data": "end_time",
            },
            {
                "render": function(data,type,full){
                   return `(${full.employee.emp_id}) ${full.employee.th_firstname} ${full.employee.th_lastname}`;
                }
            },
            {
                "data": "user.name",
            },
            {
                "data": "created_at",
            },
            {
                "data": "remark",
            },
            {
                "data": "status",
                "render":function(data){
                    var html;
                    if(data == 1){
                        html = '<span class="badge badge-info btn-block">รออนุมัติ</span>';
                    }else if(data == 2){
                        html = '<span class="badge badge-primary btn-block">อนุมัติเรียบร้อย</span>';
                    }else if(data == 3){
                        html = '<span class="badge badge-warning btn-block">ไม่ผ่านอนุมัติ</span>';
                    }else{
                        html = 'อื่นๆ';
                    }
                    return html;
                }
            },
            {
                "data": "approves",
                "render":function(data,type,full){
                    return (data)? full.approves.name : null;
                }
            },
        ],
    });
    }

    $('#search').click(function(){
        let actions = $('#report-status').val();
        if(actions == 'approved'){
            tables(2);
        }else if(actions == 'unapproved'){
            tables(3);
        }else if(actions == 'waiting'){
            tables(1);
        }else{
            tables('all');
        }
    });

    $('#chage-date-type').change(function(){
        let types = $(this).val();
        let date_start = $('#input-date-start');
        let date_end = $('#input-date-end');
        date_start.find('#date-start').remove();
        date_end.find('#date-end').remove();
        if(types == 'dmy'){            
            date_start.append(`<input type="date" id="date-start" class="form-control">`);
            date_end.append(`<input type="date" id="date-end" class="form-control">`);
        }else if(types == 'my'){
            date_start.append(`<input type="month" id="date-start" class="form-control">`);
            date_end.append(`<input type="month" id="date-end" class="form-control">`);
        }else if(types == 'year'){
            date_start.append(`<select id="date-start" class="form-control">
                <option value="2020">ปี 2563</option>
                <option value="2021">ปี 2564</option>
                <option value="2022">ปี 2565</option>
                <option value="2023">ปี 2566</option>
            </select>`);
            date_end.append(`<select id="date-end" class="form-control">
                <option value="2020">ปี 2563</option>
                <option value="2021">ปี 2564</option>
                <option value="2022">ปี 2565</option>
                <option value="2023">ปี 2566</option>
            </select>`);
        }else{
            date_start.append(`<input type="text" id="date-start" class="form-control" value="ทั้งหมด" readonly>`);
            date_end.append(`<input type="text" id="date-end" class="form-control" value="ทั้งหมด" readonly>`);
        }
        
    });

$(function () {
    tables(null);
});
</script>
@endsection