@extends('layouts.app')
<style>
    .my-1 {
        margin-top: 0.5rem;
        margin-bottom: 0.5rem;
    }
</style>
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
            <h3>รายชื่อสาขา</h3>
        </h5>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-success btn-position-modal" modal-action="create">เพิ่มฝ่ายงาน</a>
        </div>
    </div>
    <div class="card-body">
        <div id="wrapper">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive" style="margin-top:25px;">
                            <table class="table table-sm" id="position_table" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th>ชื่อฝ่ายงาน</th>
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


<div class="modal fade" id="position-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>     

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#single-division" aria-controls="single-division" role="tab" data-toggle="tab" aria-expanded="true">เพิ่มฝ่ายงาน</a>
                </li>
                <li role="presentation">
                    <a href="#multiple-division" aria-controls="multiple-division" role="tab" data-toggle="tab">เพิ่มทีละหลายรายการ</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="single-division">
                    <div class="modal-body">               
                        <div class="form-group">
                            <label>ชื่อฝ่ายงาน</label>
                            <input type="text" class="form-control" name="position_name" id="position_name"
                                placeholder="ชื่อฝ่ายงาน">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        <button type="button" id="submit" class="btn btn-primary">บันทึก</button>
                    </div>    
                </div>
                <div role="tabpanel" class="tab-pane" id="multiple-division">                    
                        <div class="modal-body">
                            <div class="form-group" id="division-rows">
                                
                            </div>
                            <div class="form-group">
                                <button id="add-division-row" class="btn btn-block btn-warning"><i class="fa fa-plus"></i> เพิ่มแถว</button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                            <button type="button" id="submit-all" class="btn btn-primary">บันทึก</button>
                        </div>
                   
                </div>
            </div>
               
                
                
        </div>
    </div>
</div>

@endsection
@section('script')
<script>

    let action = '';
    let modal = $('#position-modal');
    let positionID = '';

    $('#add-division-row').click(function(e){
        $('#division-rows').append($('<input>').attr('type','text').addClass('form-control my-1'));
    });
           
        $('.btn-position-modal').click(function () {            
            action = $(this).attr('modal-action');
            modal.find('.modal-title').html('เพิ่มข้อมูลฝ่ายงาน');
            modal.find('.form-control').val('');
            $('#division-rows').empty().append($('<input>').attr('type','text').addClass('form-control my-1'));
            modal.modal('show');
        });

        $('#submit').click(function () {
            if (action === 'create') {
                create();
            } else if (action === 'update') {
                update();
            }
        });

        $('#submit-all').click(function () {
            let division_collections = [];
            $('#division-rows > input').each(function () {
                (this.value != '')?division_collections.push(this.value) : false;                
            });
            $.post("/save-divisions", data = {
                    _token: '{{ csrf_token() }}',
                    name: division_collections,
                },
                function (res) {
                    swal.fire(res.title, res.msg, res.status).then(function(){
                        position_table.ajax.reload(null, false);
                        (res.status == 'success') ? modal.modal('hide'): true;                        
                    });                    
                },
            );
        });

        function create() {
            $.post("divisions", data = {
                    _token: '{{ csrf_token() }}',
                    name: $('#position_name').val(),
                    description: $('#position_description').val()
                },
                function (res) {
                    swal.fire(res.title, res.msg, res.status).then(function(){
                        position_table.ajax.reload(null, false);
                        (res.status == 'success') ? modal.modal('hide'): true;                        
                    });                    
                },
            );
        }

        function edit(id) {
            $.post("divisions/"+id+"/edit", data = {
                _token : "{{ csrf_token()}}",
                id : id
            },
                function (res) {
                    action = 'update';
                    positionID = res.id;
                    $('#position_name').val(res.name);
                    $('#position_description').val(res.description);
                },
            ).done(function(){
                modal.find('.modal-title').html('แก้ไขข้อมูลพนักงาน');
                modal.modal('show');
            });
        }

        function update() {
            $.post("divisions/"+positionID, data = {
                    _token: '{{ csrf_token() }}',
                    id: positionID,
                    name: $('#position_name').val(),
                    description: $('#position_description').val()
                },
                function (res) {
                    swal.fire(res.title, res.msg, res.status).then(function(){
                        position_table.ajax.reload(null, false);
                        (res.status == 'success') ? modal.modal('hide'): true;                        
                    });                    
                },
            );
        }

        var position_table = $('#position_table').DataTable({
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
            "url": "/get-divisions",
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
                "data": "name",
            },
            {
                "data": "id",
                "render":function(data){
                    return '<button class="btn btn-sm btn-warning" onclick="edit('+ data +')">Edit</button>';
                }
            },     

            
        ],
    });


    

    
</script>
@endsection
