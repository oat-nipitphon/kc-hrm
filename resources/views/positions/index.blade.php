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
            <h3>รายชื่อสาขา</h3>
        </h5>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-success btn-position-modal" modal-action="create">เพิ่มตำแหน่งงาน</a>
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
                                        <th>ชื่อตำแหน่ง</th>
                                        <th>แผนก</th>
                                        <th>ฝ่าย</th>
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
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>ชื่อตำแหน่ง</label>
                        <input type="text" class="form-control" name="position_name" id="position_name" placeholder="ชื่อตำแหน่ง">
                      </div>
                      <div class="form-group">
                        <label>แผนก</label>
                        <select name="section_id" id="section_id" data-live-search="true" class="form-control selectpicker">
                            <option value="0">กรุณาเลือก</option>
                            @foreach ($sections as $section)
                            <option value="{{$section->id}}">{{$section->name}} ({{$section->division_name}})</option>
                            @endforeach
                        </select>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                    <button type="button" id="submit" class="btn btn-primary">บันทึก</button>
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
           
        $('.btn-position-modal').click(function (e) {            
            action = $(this).attr('modal-action');
            modal.find('.modal-title').html('เพิ่มข้อมูลตำแหน่งงาน');
            modal.find('.form-control').val('');
            modal.modal('show');
            $('#section_id').val(0).selectpicker('refresh');
        });

        $('#submit').click(function () {
            if (action === 'create') {
                create();
            } else if (action === 'update') {
                update();
            }
        });


       

        function create() {
            $.post("positions", data = {
                    _token: '{{ csrf_token() }}',
                    name: $('#position_name').val(),
                    section_id: $('#section_id').val()
                },
                function (res) {
                    swal.fire(res.title, res.msg, res.status).then(function(){
                        position_table.ajax.reload(null, false);
                        // (res.status == 'success') ? modal.modal('hide'): true;

                    });                    
                },
            );
        }

        function edit(id) {
            $.post("positions/"+id+"/edit", data = {
                _token : "{{ csrf_token()}}",
                id : id
            },
                function (res) {
                    action = 'update';
                    positionID = res.id;
                    $('#position_name').val(res.name);
                    $('#section_id').val(res.section_id).selectpicker('refresh');
                },
            ).done(function(){
                modal.find('.modal-title').html('แก้ไขข้อมูลพนักงาน');
                modal.modal('show');
            });
        }

        function update() {
            $.post("positions/"+positionID, data = {
                    _token: '{{ csrf_token() }}',
                    id: positionID,
                    name: $('#position_name').val(),
                    section_id: $('#section_id').val()
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
            "url": "/get-positions",
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
                "data": "section_name",
            },
            {
                "data": "division_name",
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
