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

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="card-header">
        <h5 class="card-title">
            <h3>Permission management</h3>
        </h5>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a class="btn btn-success btn-position-modal" id="permission-modal-btn">เพิ่ม Permission</a>
        </div>
    </div>
    <div class="card-body">
        xx
    </div>
</div>


<div class="modal fade" id="permission-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Permission</h4>
            </div>
            <form id="form-save-permission" action="/save-permission" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>กลุ่มผู้ใช้งาน <a href="javascript:void(0)" id="add-group"><span
                                    class="badge badge-info"><i
                                        class="fas fa-plus"></i>เพิ่มกลุ่มผู้ใช้งานใหม่</span></a>
                        </label>
                        <select class="form-control selectpicker" name="section-groups" id="section-groups">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>กลุ่มผู้ใช้งาน</label>
                        <select class="form-control selectpicker" name="display_name" id="section-sub-groups">

                        </select>
                    </div>
                    <div class="form-group">
                        <label>Permission name</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description" id="description">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
let get_groups = async (group_id) => {
    var groups = $('#section-groups');
    $.post("/get-group-permissions", data = {
            _token: '{{ csrf_token() }}'
        },
        function (res) {
            groups.empty();
            res.forEach(element => {
                groups.append($(`<option></option>`).val(element.id).text(element.name));                
            });
            if(group_id){
                groups.val(group_id);
            }
            groups.selectpicker('refresh');
        },
    ).done(function() {
        get_sub_groups();
  });
}

let get_sub_groups = async () => {
    var sub_groups = $('#section-sub-groups');
    $.post("/get-sub-group-permissions", data = {
            group_id : $('#section-groups').val(),
            _token: '{{ csrf_token() }}'
        },
        function (res) {
            sub_groups.empty();
            if (res.length) {
                res.forEach(element => {
                    sub_groups.append($(`<option></option>`).val(element.group_name).text(element.name));
                });
            }else{
                sub_groups.append($(`<option></option>`).val('').text('ไม่พบข้อมูล'));
            }
            sub_groups.selectpicker('refresh');
        },
    );
}

$('#add-group').click(function () {
    Swal.fire({
        title: 'ชื่อกลุ่มใหม่',
        input: 'text',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'บันทึก',
        cancelButtonText: 'ยกเลิก',        
    }).then((result) => {
        if (result.value) {
            $.post("/save-group-permission", data = {
                name : result.value,
                _token: '{{ csrf_token() }}'
            },
                function (res) {
                    get_groups(res);
                },
            ).done(function(){
                swal.fire('Success','เพิ่มกลุ่มสำเร็จ','success');
            });
        }
    })
});

$('#form-save-permission').submit(function(e){
    e.preventDefault();
    let url = $(this).attr('action');
    let formData = $(this).serialize();
    $.post(url, formData,
        function (res) {
            console.log(res);
        },
    );
});

$('#permission-modal-btn').click(function () {    
    $('#permission-modal').modal('show');
});

$('#section-groups').change(function(){
    get_sub_groups();
});

$(document).on('shown.bs.modal', function() {
    $(document).off('focusin.modal');
});

$(function () {
    get_groups(false);    
});
</script>

@endsection