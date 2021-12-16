@extends('layouts.app')

@section('breadcrumb')
@if($actions == 'create')
<h2>เพิ่มพนักงาน</h2>
@elseif($actions == 'edit')
<h2>แก้ไขพนักงาน</h2>
@else
<h2>ดูข้อมูลพนักงาน</h2>
@endif  
<ol class="breadcrumb">
  <li>
    <a href="{{route('employees.index')}}"><strong>หน้าหลัก</strong></a>
  </li>
  <li class="active">
    @if($actions == 'create')
      <strong>เพิ่มพนักงาน</strong>
    @elseif($actions == 'edit')
      <strong>แก้ไขพนักงาน</strong>
    @else
      <strong>ดูข้อมูลพนักงาน</strong>
    @endif    
  </li>
</ol>
@endsection
<style scoped>
  .radio {
    padding-left: 35px;
  }

  .popover-content {
    color: red;
    font-size: 1.1rem;
  }

  .datepicker-years .year,
  .datepicker-months .month,
  .datepicker-days .day {
    font-size: 1.2rem !important;
  }

  .datepicker-switch,
  .datepicker-days .dow,
  .datepicker .today {
    font-size: 1.3rem;
  }
</style>
@section('content')
<div class="col-12">
  <div class="row border-bottom">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title" style="border-top:none!important;">
          
            @if($actions == 'create')
            <form method="post" enctype="multipart/form-data" class="form-horizontal"
            action="{{ route('employees.store') }}">          
            @elseif($actions == 'edit')
              <form method="post" class="form-horizontal" action="{{ route('employees.update',$id) }}" enctype="multipart/form-data">
              <input type="hidden" name="_method" value="PUT" />
            @else
            <form class="form-horizontal">
            @endif

            @csrf
            <div class="ibox text-right">
              @if($actions == 'create' or $actions == 'edit')
                <button class="btn btn-primary" type="submit">ยืนยัน</button>
              @elseif($actions == 'view')
                <a href="/employees/{{$id}}/edit" class="btn btn-warning">แก้ไข</a>              
              @endif
              <a class="btn btn-success" href="{{ route('employees.index') }}">กลับ</a>
            </div>

            <div class="ibox">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a href="#employee-profile" aria-controls="employee-profile" role="tab" data-toggle="tab">
                    <i class="fas fa-user"></i> ข้อมูลพนักงาน
                  </a>
                </li>
                <li role="presentation">
                  <a href="#employee-position" aria-controls="employee-position" role="tab" data-toggle="tab">
                    <i class="fas fa-users-cog"></i> สาขา/แผนก/ตำแหน่ง
                  </a>
                </li>
              </ul>
            </div>

            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="employee-profile">
                @include('employees.contents.emp-profile')
              </div>
              <div role="tabpanel" class="tab-pane" id="employee-position">
                @include('employees.contents.emp-position')
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script>
  var actions = '{{$actions}}';
  var employee_id = '{{$id}}';
  $('.upload-image').click(function () {
    $('#emp_image').click();
  });

  $('#emp_image').change(function () {
    if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#emp-preview-profile').attr('src', e.target.result);
      }
      reader.readAsDataURL(this.files[0]);
    }
  });

  $('#id_passport').blur(function () {
    let valid_id_passport = check_number($(this).val());
    if ($(this).val()) {
      if (!valid_id_passport) {
        $(this).attr('data-content', '*กรุณากรอกเป็นตัวเลขเท่านั้น');
        $(this).popover("toggle");
      }
    }
  });

  $('#id_passport').focusin(function () {
    $(this).popover("hide");
  });

  $('#tel_number').blur(function () {
    let valid_id_passport = check_number($(this).val());
    if ($(this).val()) {
      if (!valid_id_passport) {
        $(this).attr('data-content', '*กรุณากรอกเป็นตัวเลขเท่านั้น');
        $(this).popover("toggle");
      }
    }
  });

  $('#tel_number').focusin(function () {
    $(this).popover("hide");
  });


  $('#date-picker .input-group.date').datepicker({
    startView: 2,
    todayBtn: "linked",
    keyboardNavigation: false,
    forceParse: false,
    autoclose: true,
    format: "yyyy/mm/dd"
  });

  function check_number(numVal) {
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    (numberRegex.test(numVal)) ? test = true: test = false;
    return test;
  }

  $('#guarantor-coop-emergency').change(function () {
    if ($(this).is(':checked')) {
      $('#emergency_firstname').val($('#guarantor_firstname').val());
      $('#emergency_lastname').val($('#guarantor_lastname').val());
      $('#emergency_relative').val($('#guarantor_relative').val());
    } else {
      $('#emergency_firstname').val('');
      $('#emergency_lastname').val('');
      $('#emergency_relative').val('');
    }
  });

  load_world_national = () => {
    $.ajax({
      method: "GET",
      url: "/js/world-national.js",
      dataType: "JSON",
      success: function (res) {
        res.forEach(element => {
          $('#national').append($('<option></option>').attr('value', element.nationality).text(element
            .nationality));
        });
      }
    }).done(function () {
      $('#national').selectpicker();
    });
  }

  $('#warehouses').change(function () {
    draw_position_table($(this).val());
  });

  get_position = (warehouse_position_id,position,section,division) => {
    let warehouse = $('#warehouses option:selected').text();
  
    $('#positions-area').append(`
      <div class="form-group text-left" id="position-area-${warehouse_position_id}">
        <div class="text-right">
          <button type="button" onclick="delete_pos('position-area-${warehouse_position_id}')" class="btn btn-danger btn-sm" style="position:absolute;right: 20px;">
              ลบ
          </button>
        </div>        
        <div class="table-bordered" style="padding: 5px!important;">
          <ul style="margin-bottom:0px;list-style-type:none;">
            <li>สาขา : ${warehouse}</li>
            <li>ตำแหน่ง : ${position}</li>
            <li>แผนก : ${section}</li>
          </ul>
        </div>
        <input type="hidden" class="form-control" name="warehouse_position_id[]" value="${warehouse_position_id}">        
      </div>
    `);
  }

  delete_pos = (del) => {
    $(`#${del}`).remove();
  }

  draw_position_table = (id) => {
    warehouses_position_table = $('#warehouses_position_table').DataTable({
      "destroy": true,
      "pageLength": 50,
      "ordering": false,
      "bPaginate": false,
      "searching": false,
      "info": false,
      "responsive": true,
      "bFilter": false,
      "bLengthChange": false,
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
        "className": "text-left",
      }, ],
      "columns": [{
          "data": "position_name",
        },
        {
          "data": "section_name",
        },
        {
          "data": "division_name",
        },
        {
          "data" : "id",
          "render": function (data,typ,full) {
            return `<a href="javascript:void(0)" type="button" class="badge badge-primary" onclick="get_position(${data},'${full.position_name}','${full.section_name}','${full.division_name}')"><i class="fas fa-plus"></i> เพิ่มข้อมูล</a>`;
          },
        },
      ],
    });
  }

  load_employee = () => {
    $.post("/get-employee-self", data = {
      id: employee_id,
      _token: '{{ csrf_token() }}',
    },
      function (res) {
        $('#title').val(res.title).selectpicker('refresh');
        $('#date_of_birth').val(res.date_of_birth);
        (res.relation_status) ?  $('#relation_status').val(res.relation_status).selectpicker('refresh'):true;       
        $('.sex').filter(function(){return this.value==res.sex}).prop("checked", true);
        $('#th_firstname').val(res.th_firstname);
        $('#th_lastname').val(res.th_lastname);
        // $('#en_firstname').val(res.en_firstname);
        // $('#en_lastname').val(res.en_lastname);
        $('#email_address').val(res.email_address);
        $('#tel_number').val(res.tel_number);
        (res.national) ? $('#national').val(res.national).selectpicker('refresh'):true;
        $('#id_passport').val(res.id_passport);

        if(res.emp_position){
          // console.log(res.emp_position);
          res.emp_position.forEach(element => {
            let warehouse_position_id = element.warehouse_position.id;
            let position = element.warehouse_position.get_position.name;
            let section = element.warehouse_position.get_position.get_section.name;
            let division = element.warehouse_position.get_position.get_section.get_division.name;
            let warehouse = element.warehouse_position.get_warehouse.name;
            let html = `
              <div class="form-group text-left" id="position-area-${warehouse_position_id}">
                <div class="text-right">
                  <button type="button" onclick="delete_pos('position-area-${warehouse_position_id}')" class="btn btn-danger btn-sm" style="position:absolute;right: 20px;">
                      ลบ
                  </button>
                </div>        
                <div class="table-bordered" style="padding: 5px!important;">
                  <ul style="margin-bottom:0px;list-style-type:none;">
                    <li>สาขา : ${warehouse}</li>
                    <li>ตำแหน่ง : ${position}</li>
                    <li>แผนก : ${section}</li>
                  </ul>
                </div>
                <input type="hidden" class="form-control" name="warehouse_position_id[]" value="${warehouse_position_id}">        
              </div>`;
            $('#positions-area').append(html);       
          });
        }       
      },
    );
  }

  $(document).ready(function () {
    load_world_national();
    draw_position_table();
    if(actions == 'view'){
      $('input').prop('disabled',true);
      $('select').prop('disabled','disabled');
      load_employee();
    }
    if(actions == 'edit'){
      load_employee();
    }
  });
</script>
@endsection