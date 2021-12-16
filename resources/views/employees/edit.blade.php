@extends('layouts.app')

@section('breadcrumb')
<h2>แก้ไข</h2>
<ol class="breadcrumb">
  <li>
    <a href="{{route('employees.index')}}"><strong>หน้าหลัก</strong></a>
  </li>
  <li>
    <a href="{{route('employees.show',$employee->id)}}"><strong>รายละเอียด</strong></a>
  </li>
  <li class="active">
    <strong>แก้ไข</strong>
  </li>
</ol>
@endsection

@section('content')

<div class="">
  <div class="row wrapper border-bottom white-bg page-heading">

    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <div class="ibox">
              <h5>แก้ไข <small></small></h5>
            </div>
            <form method="post" class="form-horizontal" action="{{ route('employees.update',$employee->id) }}" enctype="multipart/form-data">
              <input type="hidden" name="_method" value="PUT" />
              @csrf

              
              <div class="ibox">
                <button class="btn btn-primary" type="submit">ยืนยัน</button>
                <a class="btn btn-success" href="{{ route('employees.update',$employee->id) }}">กลับ</a>
              </div>

              <div class="ibox-content">
                <div class="form-group">
                  <div class="row">
                    <div class="col-sm-3">
                      <img 
                        style="cursor:pointer;width:100%;max-height:250px;" 
                        class="btn-block upload-image"
                        id="emp-preview-profile"
                        @if($employee->image)
                        src="{{ asset("storage/".$employee->image) }}""
                        @else
                        src="https://via.placeholder.com/250"
                        @endif                         
                        alt="emp-preview-profile">
                      <button type="button" class="btn btn-info btn-block upload-image">เลือกรูปภาพพนักงาน</button>
                      <input style="display:none;" type="file" name="emp_image" id="emp_image">
                    </div>
                    <div class="col-sm-9">
                      <div class="form-group">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>คำนำหน้า</label>
                          <select class="form-control selectpicker" data-live-search="true" name="title" id="title"
                            required>
                            <option value="">กรุณาเลือก</option>
                            @foreach ($titles as $title)
                            <option value="{{$title->id}}">{{$title->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12" id="date-picker">
                          <label>วันเกิด</label>
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value="{{$employee->date_of_birth}}" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="ปี/เดือน/วัน">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>สถานภาพ</label>
                          <select class="form-control selectpicker" data-live-search="true" name="relation_status" id="relation_status"
                            required>
                            <option>กรุณาเลือก</option>
                            <option value="1">โสด</option>
                            <option value="2">แต่งงานแล้ว</option>
                            <option value="3">หม้าย</option>
                            <option value="4">หย่า หรือ แยกกันอยู่</option>
                          </select>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <label>เพศ</label>
                          <div class="row">
                            <div class="radio sex">
                              <label>
                                <input type="radio" name="sex" value="1" @if($employee->sex == 1) checked @endif>ชาย
                              </label>
                            </div>
                            <div class="radio">
                              <label>
                                <input type="radio" name="sex" value="2" @if($employee->sex == 2) checked @endif>หญิง
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <label>ชื่อ(ภาษาไทย)</label>
                          <input type="text" class="form-control" id="th_firstname" name="th_firstname" placeholder="ชื่อ"
                          required value="{{$employee->th_firstname}}">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <label>นามสกุล(ภาษาไทย)</label>
                          <input type="text" class="form-control" id="th_lastname" name="th_lastname"
                            placeholder="นามสกุล" required value="{{$employee->th_lastname}}">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <label>ชื่อ(ภาษาอังกฤษ)</label>
                          <input type="text" class="form-control" id="en_firstname" name="en_firstname"
                            placeholder="First name" value="{{$employee->en_firstname}}" required>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <label>นามสกุล(ภาษาอังกฤษ)</label>
                          <input type="text" class="form-control" id="en_lastname" name="en_lastname"
                            placeholder="Last name" value="{{$employee->en_lastname}}" required>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <label>Email</label>
                          <input type="email" class="form-control" id="email_address" name="email_address"
                            placeholder="Email" value="{{$employee->email_address}}">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-sm-9 col-sm-offset-3 col-md-offset-0">
                      <div class="form-group">
                        <div class="col-md-4 col-sm-12">
                          <label>เบอร์โทรติดต่อ</label>
                          <input type="text" name="tel_number" id="tel_number" class="form-control" placeholder="เบอร์โทรศัพท์"
                          data-toggle="popover" data-trigger="manual" data-placement="bottom" data-content="" value="{{$employee->tel_number}}">
                        </div>
                        <div class="col-md-4 col-sm-12">
                          <label>สัญชาติ</label>
                          <select class="form-control" data-live-search="true" name="national" id="national"
                            required>
                            <option>กรุณาเลือก</option>
                          </select>
                        </div>
                        <div class="col-md-4 col-sm-12">
                          <label>เลขประจำตัวประชาชน/หนังสือเดินทาง</label>
                          <input type="text" name="id_passport" id="id_passport" class="form-control" placeholder="ID card / Passport"
                            data-toggle="popover" data-trigger="manual" data-placement="bottom" data-content="" value="{{$employee->id_passport}}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

        
              <div class="ibox">
                <h5>ข้อมูลผู้คำประกัน</h5>
              </div>
              <div class="ibox-content">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12 col-sm-9 col-sm-offset-3 col-md-offset-0">
                      <div class="form-group">
                        <div class="col-md-4 col-sm-12">
                          <label>ชื่อ</label>
                        <input type="text" name="guarantor_firstname" id="guarantor_firstname" class="form-control" value="{{ @$guarantor->firstname }}" placeholder="ชื่อผู้ค้ำประกัน">
                        </div>
                        <div class="col-md-4 col-sm-12">
                          <label>นามสกุล</label>
                          <input type="text" name="guarantor_lastname" id="guarantor_lastname" class="form-control" value="{{ @$guarantor->lastname }}" placeholder="นามสกุลผู้ค้ำประกัน">
                        </div>
                        <div class="col-md-4 col-sm-12">
                          <label>เกี่ยวข้องเป็น</label>                        
                          <input type="text" name="guarantor_relative" id="guarantor_relative" class="form-control" value="{{ @$guarantor->relative }}" placeholder="ความเกี่ยวข้อง">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
 
              <div class="ibox" style="margin-bottom:0px!important;">
                <h5>ข้อมูลผู้ติดต่อฉุกเฉิน</h5> 
                <div class="checkbox" style="padding-top:0px;">
                  <label style="margin-left:15px;">
                    <input type="checkbox" id="guarantor-coop-emergency"> <span class="text-info">*เหมือนกับข้อมูลของผู้คำประกัน</span>
                  </label>
                </div>
              </div>
              <div class="ibox-content">
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-12 col-sm-9 col-sm-offset-3 col-md-offset-0">
                      <div class="form-group">
                        <div class="col-md-4 col-sm-12">
                          <label>ชื่อ</label>
                          <input type="text" name="emergency_firstname" id="emergency_firstname" class="form-control" value="{{ @$emergency->firstname }}" placeholder="ชื่อผู้ติดต่อฉุกเฉิน">
                        </div>
                        <div class="col-md-4 col-sm-12">
                          <label>นามสกุล</label>
                          <input type="text" name="emergency_lastname" id="emergency_lastname" class="form-control" value="{{ @$emergency->lastname }}" placeholder="นามสกุลผู้ติดต่อฉุกเฉิน">
                        </div>
                        <div class="col-md-4 col-sm-12">
                          <label>เกี่ยวข้องเป็น</label>                        
                          <input type="text" name="emergency_relative" id="emergency_relative" class="form-control" value="{{ @$emergency->relative }}" placeholder="ความเกี่ยวข้อง">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
      
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script>

 
  var national;
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

  $(document).ready(function () {
    $.post("/js/world-national.js", data = "_token: '{{ csrf_token() }}',",
      function (res) {
        national = res;
        national.forEach(element => {
          $('#national').append($('<option></option>').attr('value', element.nationality).text(element
            .nationality));
        });        
      },
      "JSON"
    ).done(function() {
      $('#national').val('{{$employee->national}}').selectpicker();
    })

    $('#title').val('{{$employee->title}}');
    $('#relation_status').val('{{$employee->relation_status}}');
  });
</script>
@endsection

