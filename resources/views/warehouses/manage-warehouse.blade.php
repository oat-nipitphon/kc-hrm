@extends('layouts.app')
@section('breadcrumb')

<h2>จัดการสาขา</h2>
<ol class="breadcrumb">
  <li>
    <a href="#">หน้าหลัก</a>
  </li>
  <li>
    <a href="{{ route('warehouses.index') }}">สาขา</a>
  </li>
  <li class="active">
    <strong>จัดการสาขา</strong></a>
  </li>
</ol>

@endsection

@section('content')

<div class="panel panel-default" style="border:none!important;padding-top:1em;">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#warehouse-view" aria-controls="warehouse-view" role="tab" data-toggle="tab"
                aria-expanded="true"><i class="fas fa-building"></i>สาขา</a>
        </li>
        <li role="presentation">
            <a href="#warehouse-position" aria-controls="warehouse-position" role="tab" data-toggle="tab"><i class="fas fa-user-tie"></i> ตำแหน่งงาน</a>
        </li>
        <li role="presentation">
            <a href="#warehouse-employee" aria-controls="warehouse-employee" role="tab" data-toggle="tab">พนักงาน</a>
        </li>
        <li role="presentation">
            <a href="#warehouse-manpower" aria-controls="warehouse-manpower" role="tab"
                data-toggle="tab">อัตรากำลังคน</a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="warehouse-view">
            @include('warehouses.pages.view-warehouse')
        </div>
        <div role="tabpanel" class="tab-pane" id="warehouse-position">
            @include('warehouses.pages.view-warehouse-position')
        </div>
        <div role="tabpanel" class="tab-pane" id="warehouse-employee">
          
        </div>
        <div role="tabpanel" class="tab-pane" id="warehouse-manpower">
           
        </div>
    </div>       
</div>








@endsection
@section('script')
<script>
    //global var
    var warehouse_id = 0;
    var warehouses_position_table;
    let warehouses_table = $('#warehouses_table').DataTable({       
        "destroy": true,
        "pageLength": 50,
        "ajax": {
            "url": "/get-warehouses",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
            },
        },
        "columns": [       
            {
                "data": "code",
            },
            {
                "data": "name",
            },
            {
                "data": "line_name",
            },
            {
                "data": "line_token",
            },
            {
                "data": "is_active",
                "render": function(data,type,full){
                    if(data == 1){
                        btn = '<span class="badge badge-primary">เปิดทำการ</span>';
                    }else{
                        btn = '<span class="badge badge-danger">ปิดทำการ</span>';
                    }
                    return btn;
                }
            },
            {
                "data": "id",
                "render":function(data,type,full){
                  return `<a href="javascript:void(0)" class="btn btn-warning btn-sm"><i class="fa fa-wrench"></i> แก้ไข</a>`;
                }
            },            
        ],
    });

function draw_position_table(id){
    warehouses_position_table = $('#warehouses_position_table').DataTable({
        "destroy": true,
        "pageLength": 50,
        "destroy": true,
        "order": [
            [0, "asc"]
        ],
        "ajax": {
            "url": "/get-warehouses-position",
            "method": "POST",
            "data": {
                "_token": "{{ csrf_token()}}",
                "id": id
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
                "data": "position_name",
            },
            {
                "data": "section_name",
            },
            {
                "data": "division_name",
            },        
        ],
    });
}
  

    var warehouse_list = () => {
        $.post("/get-warehouses", data = {
            _token: '{{ csrf_token() }}',
        },
            function (res) {
                let select = $('#warehouse-list');
                select.empty();
                res.data.forEach(element => {
                    select.append($(`<option></option>`)
                            .val(element.id)
                            .text(`${element.name} (${element.code})`))
                            .attr('data-live-search',true)
                            .selectpicker('refresh');
                });
            },
        );
    }

    // $('#warehouse-list').change(function(){
    //     warehouse_id = $(this).val();
    // });

    $('#search-warehouse').click(function () {
        warehouse_id = $('#warehouse-list').val();
        draw_position_table(warehouse_id);
    });

    

    $(function () {
        warehouse_list();
    });
</script>
@endsection