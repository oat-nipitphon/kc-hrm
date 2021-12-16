@extends('layouts.app')

@section('breadcrumb')
<h2>เพิ่ม User</h2>
<ol class="breadcrumb">
  <li>
    <a href="{{route('employees.index')}}"><strong>หน้าหลัก</strong></a>
  </li>
  <li>
    <a href="{{route('employees.show',$employees->id)}}"><strong>รายละเอียด</strong></a>
  </li>
  <li class="active">
    <strong>เชื่อมต่อ User</strong>
  </li>
</ol>
@endsection

@section('content')


<div class="container">
  <div class="row wrapper border-bottom white-bg page-heading">

    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <div class="ibox">
              <h5>เชื่อมต่อ User <small></small></h5>
            </div>
            <form method="post" class="form-horizontal" action="{{ route('employee.users.store',$employees->id)}}" >
              {{ csrf_field() }}
                <input type="hidden" name="employees_id" id="employees_id" value="{{$employees->id}}">
              
              <div class="ibox">
                <button class="btn btn-primary" type="submit">ยืนยัน</button>
                <a class="btn btn-success" href="{{ route('employees.update',$employees->id) }}">กลับ</a>
              </div>

              <div class="ibox-content">
                <div class="form-group"><label class="col-sm-2 control-label">Name</label>

                  <div class="col-sm-10"><input type="text" class="form-control" id="name" name="name" placeholder="name"   required></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Username</label>

                  <div class="col-sm-10"><input type="text" class="form-control" id="username" name="username" placeholder="username" required></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-10"><input type="text" class="form-control" id="email" name="email" placeholder="email" required"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Password</label>

                  <div class="col-sm-10"><input type="text" class="form-control" id="password" name="password" placeholder="password" required></div>
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


<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>