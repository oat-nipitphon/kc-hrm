@extends('layouts.app')
<style>
    label {
    display: block;
    font: 16px;
    }

    input,
    label {
        margin: .4rem 0;
    }
</style>
@section('breadcrumb')
    <h2>ค้นหารายงาน</h2>
    <ol class="breadcrumb">
        <li class="active">
            <strong>หน้าหลัก</strong>
            /
            <strong><a href="{{ route('kc-hrm.report') }}">ค้นหารายงาน</a></strong>
        </li>
    </ol>
@endsection
@section('content')

{{-- Menu Select Report Kc Hrm --}}
<div class="card-body white-bg page-heading">
    <div class="row">

        <div class="col-lg-12">
            <div class="col-lg-4">
                <label>เลือกรายงาน</label>
                <select class="form-control" id="check_type">
                    <option value="all">ทั้งหมด</option>
                    <option value="OT">OT</option>
                    <option value="Leave">ลากิจ</option>
                </select><br><br>
            </div>

            <div class="col-lg-4">
                <label>เลือกประเภทรายงาน</label>
                <select class="form-control" id="check_status">
                    <option value="all">ทั้งหมด</option>
                    <option value="1">รอการอนุมัติ</option>
                    <option value="2">อนุมัติเรียบร้อย</option>
                    <option value="3">ไม่อนุมัติ</option>
                </select><br><br>
            </div>

            <div class="col-lg-4">
                <label>ค้นหาจากชื่อ</label>
                <input type="text" class="form-control" id="check_name"><br><br>
            </div>
        </div>

        <div class="col-lg-12" >
            <div class="col-lg-4">
                <label>เลือกรูปแบบรายงาน (รายวัน เดือน ปี)</label>
                <select class="form-control" id="type_date">
                    <option value="all">ทั้งหมด</option>
                    <option value="day">วัน/เดือน/ปี</option>
                    <option value="mon">เดือน/ปี</option>
                    <option value="year">ปี</option>
                    <option value="start_date">ตั้งแต่วัน</option>
                    <option value="end_date">สิ้นสุดวัน</option>
                    <option value="timenow">วันที่ปัจุบัน</option>
                </select><br><br>
            </div>

            <div class="col-lg-4" id="input_start_date">
                <label id="label-start"></label>
                {{-- <input type="date" id="start_date" class="form-control" value="YYYY-MM-DD"><br><br> --}}
            </div>

            <div class="col-lg-4" id="input_end_date">
                <label id="label-end"></label>
                {{-- <input type="date" id="end_date" class="form-control" value="YYYY-MM-DD"><br><br> --}}
            </div>
        </div>
        <div class="col-lg-12" style="text-align: center;">
            <button type="submit" class="btn btn-info search" id="search">
                <i class="fas fa-search"></i>ค้นหา
            </button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn btn-danger" id="reset_search">
                รีเช็คค้นหา
            </button>  
        </div>
    </div>
</div>

{{-- Table List Report Kc Hrm --}}
<div class="card-body">
    <div id="wrapper">
        <div class="col-6">
            <div class="table-responsive" style="margin-top:25px;">
                <table class="table table-sm table-striped" id="search_table" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5%">#</th>
                            <th class="text-center">ประเภท</th>
                            <th class="text-center" style="width: 15%">เวลาเริ่ม</th>
                            <th class="text-center" style="width: 15%">เวลาสิ้นสุด</th>
                            <th class="text-center" style="width: 20%">พนักงาน</th>
                            <th class="text-center">ผู้ขอ</th>
                            <th class="text-center" style="width: 15%">วันที่ทำรายการ</th>
                            <th class="text-center">หมายเหตุ</th>
                            <th class="text-center">สถานะ</th>
                            <th class="text-center">อนุมัติโดย</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>

    //Button Search
    $('#search').click(function()
    {
        console.log($('#start_date').val());
        console.log($('#end_date').val());
        console.log($('#check_status').val());
        console.log($('#type_date').val());
        console.log($('#check_name').val());

        let check_type = $('#check_type').val();
        if(check_type == 'OT')
        {
            tables('OT');
        }
        else if(check_type == 'Leave')
        {
            tables('Leave');
        }
        else
        {
            tables('all');
        }
    });

    //Button Reset
    $('#reset_search').click(function()
    {
        let check_type = $('#check_type');
        let check_status = $('#check_status');
        let type_date = $('#type_date');
        let check_name = $('#check_name');
        let start_date = $('#start_date');
        let end_date = $('#end_date');

        check_type.find('#check_type').remove();
        check_status.find('#check_status').remove();
        type_date.find('#type_date').remove();
        check_name.find('#check_name').remove();
        start_date.find('#start_date').remove();
        end_date.find('#end_date').remove();

        check_type.append( `<select class="form-control" id="check_type">
                    <option value="all">ทั้งหมด</option>
                    <option value="OT">OT</option>
                    <option value="Leave">ลากิจ</option>
                </select>` );

        check_status.append( `<select class="form-control" id="check_status">
                    <option value="all">ทั้งหมด</option>
                    <option value="1">รอการอนุมัติ</option>
                    <option value="2">อนุมัติเรียบร้อย</option>
                    <option value="3">ไม่อนุมัติ</option>
                </select>` );

        type_date.append( `<select class="form-control" id="type_date">
                    <option value="all">ทั้งหมด</option>
                    <option value="day">วัน/เดือน/ปี</option>
                    <option value="mon">เดือน/ปี</option>
                    <option value="year">ปี</option>
                </select>` );

        check_name.append( `<input type="text" class="form-control" id="check_name">` );

        type_date.append( `<select class="form-control" id="type_date">
                    <option value="all">ทั้งหมด</option>
                    <option value="day">วัน/เดือน/ปี</option>
                    <option value="mon">เดือน/ปี</option>
                    <option value="year">ปี</option>
                    <option value="start_date">ตั้งแต่วัน</option>
                    <option value="end_date">สิ้นสุดวัน</option>
                </select>` );


        tables('all');
    });

    //Data Table List Report Kc Hrm
    var search_table = $('#search_table').DataTable();
    tables = (data) => {        
    search_table = $('#search_table').DataTable({
     "ordering": true,
     "bPaginate": true,
     "searching": true,
     "info": false,
     "responsive": true,
     "bFilter": false,
     "bLengthChange": true,
     "destroy": true,
     "pageLength": 25,
     "ajax": {
         "url": "/kc-hrm/hrm-report/search",
         "method": "POST",
         "data": {
             "_token": "{{ csrf_token()}}",
             "check_type": data,
             "check_status": $('#check_status').val(),
             "type_date": $('#type_date').val(),
             "start_date": $('#start_date').val(),
             "end_date": $('#end_date').val(),
             "check_name": $('#check_name').val()
         },
     },
     "columns": [
         {
             "data": "id",
         },
         {
             "data": "request_type",
         },
         {
             "data": "start_time",
         },
         {
             "data": "end_time",
         },
         {
             "render": function(data,type,full){
                return `(${full.employee.emp_id})<br>${full.employee.th_firstname} ${full.employee.th_lastname}`;
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

    //Select Type Date
    $('#type_date').change(function(){
        
        console.log($('#type_date').val()); 
        let types = $(this).val();
        let date_start = $('#input_start_date');
        let date_end = $('#input_end_date');
        let label_start = $('#label-start');
        let label_end = $('#label-end');
        date_start.find('#start_date').remove();
        date_end.find('#end_date').remove();
        label_start.find('#label-start').remove();
        label_end.find('#label-end').remove();
        if(types == 'day'){ 
            label_start.append(`
            <label id="label-start">จากวัน</label>
            `);           
            date_start.append(`
            <input type="date" id="start_date" class="form-control">
            `);
            label_end.append(`
            <label id="label-end">สิ้นสุดวัน</label>
            `);           
            date_end.append(`
            <input type="date" id="end_date" class="form-control">
            `);
        }else if(types == 'mon'){
            label_start.append(`
            <label id="label-start">จาก</label>
            `);           
            date_start.append(`
            <input type="month" id="start_date" class="form-control">
            `);
            label_end.append(`
            <label id="label-end">ถึง</label>
            `);           
            date_end.append(`
            <input type="month" id="end_date" class="form-control">
            `);
        }else if(types == 'year'){
            label_start.append(`
            <label id="label-start">จาก</label>
            `);
            date_start.append(`<select id="start_date" class="form-control">
                <option value="2020">ปี 2563</option>
                <option value="2021">ปี 2564</option>
                <option value="2022">ปี 2565</option>
                <option value="2023">ปี 2566</option>
            </select>`);
            label_end.append(`
            <label id="label-end">ถึง</label>
            `);
            date_end.append(`<select id="end_date" class="form-control">
                <option value="2020">ปี 2563</option>
                <option value="2021">ปี 2564</option>
                <option value="2022">ปี 2565</option>
                <option value="2023">ปี 2566</option>
            </select>`);
        }
        else if(types == 'start_date'){
            label_start.append(`
                <label id="label-start">จาก</label>
            `);
            date_start.append(
                `<input type="date" id="start_date" class="form-control">`
            );
            label_end.append(`
                <label id="label-end">/label>
            `);
            date_end.append(
                
            );
        }
        else if(types == 'end_date'){
            label_start.append(`
                <label id="label-start">/label>
            `);
            date_start.append(
                
            );
            label_end.append(`
                <label id="label-end">ถึง/label>
            `);
            date_end.append(
                `<input type="date" id="end_date" class="form-control">`
            );
        }
        else if(types == 'timenow'){
            label_start.append(`
                <label id="label-start">เวลา</label>
            `);
            date_start.append(
                `<input type="date" id="start_date" class="form-control" value="{{ date("Y/m/d") }}">`
            );
        }
        else{
            date_start.append(`<input type="text" id="start_date" class="form-control" value="ทั้งหมด" readonly>`);
            date_end.append(`<input type="text" id="end_date" class="form-control" value="ทั้งหมด" readonly>`);
        }
        
    });

    tables('all');

</script>
@endsection