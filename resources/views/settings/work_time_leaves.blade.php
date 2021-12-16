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
            <h3>ตั้งค่าเวลา ขาด ลา มาสาย</h3>
        </h5>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-success btn-work-time-modal" modal-action="create"><i class="fas fa-plus"></i>  เพิ่มข้อมูล</a>
        </div>
    </div>
    <div class="card-body">
        <div id="wrapper">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive" style="margin-top:25px;">
                            <table class="table table-sm table-striped" id="worktime_Table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>ชื่อ</th>
                                        <th>จำนวนวัน</th>
                                        <th>หมายเหตุ</th>
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


<div class="modal fade" id="worktime-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="save-work-time" method="post">
                    @csrf
                    <input type="hidden" id="work_time_id" name="id">
                    <div class="form-group">
                        <label>ชื่อ</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อวัน" required>
                    </div>                    
                    <div class="form-group">
                        <label>จำนวนวัน</label>
                        <input type="text" class="form-control" name="days" id="days" placeholder="จำนวนวัน" required>
                    </div>
                    <div class="form-group">
                        <label>หมายเหตุ</label>
                        <input type="text" class="form-control" name="remark" id="remark" placeholder="หมายเหตุ" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    let action = '';
    let modal = $('#worktime-modal');
    let worktimeID = '';
    let urls = '';

    $("#start_time").inputmask("99.99");
    $("#end_time").inputmask("99.99");

    //for triggered!
    $('#start_time , #end_time').keyup(function(){
        cal_worktime();
    });

    $('#break-time').click(function(){
        cal_worktime();
    });


    cal_worktime = () => {
        let start = $('#start_time').val();
        let end = $('#end_time').val();
        let total;
        if(start.length == 5 && end.length == 5){
            total = end - start;
            if(total > 0){
                if ($('#break-time').is(':checked')) {
                    total -=1;
                }
                $('#total_time').val(total);
            }
        }
        
     
    };

    
    $('.btn-work-time-modal').click(function () {
        urls = '/work-time-leave-save';
        modal.find('.modal-title').html('เพิ่มข้อมูล');
        modal.find('.form-control').val('');
        modal.modal('show');
    });



    $('#save-work-time').submit(function(e){
        e.preventDefault();
        $.ajax({
            type: "method",
            method: "POST",
            url: urls,
            data: $(this).serialize(),
            success: function (res) {
                worktime_Table.ajax.reload(null, false);
                (res.status == 'success') ? modal.modal('hide'): true;
            }
        });
    });

    function create() {
        if ($('#division_id').val() == 0) {
            swal.fire('Error', 'กรุณาเลือกฝ่ายงาน', 'warning');
        } else {
            $.post("sections", data = {
                    _token: '{{ csrf_token() }}',
                    name: $('#position_name').val(),
                    division_id: $('#division_id').val()
                },
                function (res) {
                    swal.fire(res.title, res.msg, res.status).then(function () {
                        worktime_Table.ajax.reload(null, false);
                        (res.status == 'success') ? modal.modal('hide'): true;
                    });
                },
            );
        }
    }

    function edit(id) {
        $.post("/get-worktime-leave", data = {
                _token: "{{ csrf_token()}}",
                id: id
            },
            function (res) {
                urls = '/work-time-leave-edit';
                $('#work_time_id').val(res.id);
                $('#name').val(res.name);
                $('#days').val(res.days);
                $('#remark').val(res.remark);
            },
        ).done(function () {
            modal.find('.modal-title').html('แก้ไขข้อมูลกะงาน');
            modal.modal('show');
        });
    }

    function update() {
        $.post("sections/" + worktimeID, data = {
                _token: '{{ csrf_token() }}',
                id: worktimeID,
                name: $('#position_name').val(),
                division_id: $('#division_id').val()
            },
            function (res) {
                swal.fire(res.title, res.msg, res.status).then(function () {
                    worktime_Table.ajax.reload(null, false);
                    (res.status == 'success') ? modal.modal('hide'): true;
                });
            },
        );
    }

    add_position = (worktime_id) => {

    }

    var worktime_Table = $('#worktime_Table').DataTable({
        "ordering": true,
        "bPaginate": true,
        "searching": true,
        "info": false,
        "responsive": true,
        "bFilter": false,
        "bLengthChange": true,
        "destroy": true,
        "pageLength": 25,
        "order": [
            [0, "asc"]
        ],
        "ajax": {
            "url": "/get-worktime-leave",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
            },
        },
        'columnDefs': [{
            "targets": 0,
            "className": "text-center",
        }, ],
        "columns": [{
                "data": "id",
            },
            {
                "data": "name",
            },
            
            {
                "data": "days",
            },   
            {
                "data": "remark",
            },         
            {
                "data": "id",
                "render": function (data) {
                    return `
                    <button class="btn btn-warning btn-sm" onclick="edit(${data})">แก้ไข</button>
                    
                    `;
                }
            },
        ],
    });
</script>
@endsection