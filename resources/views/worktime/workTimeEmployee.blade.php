@extends('layouts.app')
<style>
    .type-none {
        list-style-type: none;
        padding-left: 5px;
    }
</style>
@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
    <li class="active">
        <strong>หน้าหลัก</strong>
    </li>
</ol>
@endsection

@section('content')

<div class="row wrapper border-bottom page-heading">
    <div class="ibox white-bg page-content" style="margin-top:15px;">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label>สาขา</label>
                    <select id="warehouse" class="form-control selectpicker" data-live-search="true">
                        <option value="">ทั้งหมด</option>
                        @foreach ($warehouses as $warehouse)
                        <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>ตำแหน่ง</label>
                    <select id="position" class="form-control selectpicker" data-live-search="true">
                        <option value="">ทั้งหมด</option>
                        @foreach ($positions as $position)
                        <option value="{{$position->id}}">{{$position->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>แผนก</label>
                    <select id="section" class="form-control selectpicker" data-live-search="true">
                        <option value="0">ทั้งหมด</option>
                        @foreach ($sections as $section)
                        <option value="{{$section->id}}">{{$section->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>ฝ่ายงาน</label>
                    <select id="division" class="form-control selectpicker" data-live-search="true">
                        <option value="0">ทั้งหมด</option>
                        @foreach ($divisions as $division)
                        <option value="{{$division->id}}">{{$division->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row text-center">
            <button class="btn btn-info" id="search"><i class="fas fa-search"></i> ค้นหา</button>
        </div>
    </div>
    <form id="form-check-employee" action="/create-workTime-employee" method="post">
        @csrf
        <div class="ibox white-bg page-content" style="margin-top:15px;">       
            <div class="form-group">
                <h3>เวลางาน</h3>
                <select class="form-control selectpicker" name="work_time" required>
                    <option value="">กรุณาเลือกเวลางาน</option>
                    @foreach ($worktimes as $worktime)
                        <option value="{{$worktime->id}}">{{$worktime->name}} (เวลางาน {{$worktime->start_time .' - '.$worktime->end_time}} ทั้งหมด {{$worktime->end_time}} ช.ม)
                        
                        </option>
                    @endforeach                       
                </select>
            </div>
        </div>
        <div class="ibox white-bg" style="margin-top:15px;">
            <div class="card-header">
                <div class="col-md-12 col-sm-12" style="padding-top:2rem;">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h3 class="card-title">
                                <span>รายชื่อพนักงาน</span>
                            </h3>
                        </div>
                        <div class="col-md-6 col-sm-12 text-right">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i>
                                บันทึก</button>
                        </div>
                    </div>
                    <div class="row">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="wrapper">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body" style="margin-top:25px;">
                                <table class="table table-sm table-striped page-content table-responsive"
                                    id="employees-table" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th><label for="check-all"><input id="check-all" type="checkbox">
                                                    All</label></th>
                                            <th>รหัสพนักงาน</th>
                                            <th>ชื่อ - นามสกุล</th>
                                            <th>ตำแหน่ง</th>
                                            <th>เวลางาน</th>
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
    </form>
</div>




@endsection
@section('script')
<script>
    var employees_table;


    function user_data(search_data) {
        employees_table = $('#employees-table').DataTable({
            "processing": false,
            "serverSide": false,
            "info": true,
            "searching": true,
            "responsive": true,
            "bFilter": false,
            "bLengthChange": false,
            "destroy": true,
            "pageLength": 10000,
            "order": [
                [0, "asc"]
            ],
            "ajax": {
                "url": "/work-time-getemployee",
                "method": "POST",
                "data": {
                    "_token": "{{ csrf_token()}}",
                    "is_worktime": true,
                    "search_data": search_data,
                },
            },
            'columnDefs': [{
                "targets": 0,
                "className": "text-center",
                "orderable": false
            }, ],
            "columns": [{
                    "data": "id",
                    "render": function (data) {
                        return `<input type="checkbox" value="${data}" name="emp_id[]" class="checkbox-all">`;
                    }
                },
                {
                    "data": "emp_id",
                },
                {
                    "data": "th_firstname",
                    "render": function (data, type, full) {
                        return `${full.th_firstname} ${full.th_lastname}`;
                    }
                },
                {
                    "data": "emp_position",
                    "render": function (data) {
                        var html = [];
                        data.forEach(element => {
                            let position = `
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
                    "data": "emp_work_time",
                    "render":function(data) {
                        if(data){
                            return `
                                <ul style="margin-bottom:0px;list-style-type:none;padding-left:0px;">
                                    <li>ชื่อกะงาน : ${data.work_time.name}</li>
                                    <li>เวลา : ${data.work_time.start_time} - ${data.work_time.end_time}</li>
                                    <li>จำนวนชั่วโมงทำงาน : ${data.work_time.total_time} ช.ม</li>
                                </ul>
                                `
                        }else{
                            return '-';
                        }
                    }
                },
            ],
        });
    }


    $('table > thead > tr > th > label > input#check-all').click(function () {
        if ($(this).is(":checked")) {
            $('.checkbox-all').prop('checked', true);
        } else {
            $('.checkbox-all').prop('checked', false);
        }
    });



    $('table > tbody').click(function () {
        let count = 0;
        let checkbox = $(this).children().find('input.checkbox-all');
        checkbox.each(function () {
            if ($(this).is(":checked")) {
                count += 1;
            } else {
                $('#check-all').prop('checked', false);
                return false;
            }
        });
        if (count == checkbox.length) {
            $('#check-all').prop('checked', true);
        }
    });

    $('#form-check-employee').submit(function (e) {
        const url = $(this).attr('action');
        let formData = $(this).serialize();
        e.preventDefault();
        Swal.fire({
            title: 'เพิ่มเวลาทำงาน',
            text: "ต้องการจะเพิ่ม เวลางานให้พนักงาน หรือไม่",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ต้องการ',
            cancelButtonText: 'ไม่ต้องการ'
        }).then((result) => {
            if (result.value) {

                $.post(url, formData,
                    function (res) {
                        swal.fire(res.title, res.msg, res.status).then(function () {
                            employees_table.ajax.reload(null, false);
                        });
                    },
                );
            }
        })
    });

    $('#search').click(function () {
        let search_data = {
            warehouse: $('#warehouse').val(),
            position: $('#position').val(),
            section: $('#section').val(),
            division: $('#division').val()
        }
        user_data(search_data);
    });

    $(function () {
        user_data(null);
    });
</script>

@endsection