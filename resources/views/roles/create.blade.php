@extends('layouts.app') 
@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
  <li>
    <a href="#">หน้าหลัก</a>
  </li>
  <li>
    <a href="{{ route('roles.index') }}">ตั้งค่าสิทธิ์</a>
  </li>
  <li class="active">
    <strong>สร้างสิทธิ์ใหม่</strong>
  </li>
</ol>
@endsection
 
@section('content')

<form action="{{route('roles.store')}}" method="POST">
  {{ csrf_field() }}

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><strong>สร้างสิทธิ์ใหม่</strong></h1>
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> บันทึกสิทธิ์ใหม่</button>
        <a href="{{ route('roles.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i> ย้อนกลับ</a>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-12 mb-1">
      <h1><strong>รายละเอียดสิทธิ์:</strong></h1>
      <label>ชื่อสิทธิ์ ( Display Name)</label>
      <input type="text" class="form-control" name="display_name" placeholder="ชื่อสิทธิ์ ( Display Name )" required>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-12 mb-1">
      <label>ชื่อสิทธิ์ (Can not be changed)</label>
      <input type="text" class="form-control" name="name" placeholder="ชื่อสิทธิ์ ( Can not be changed )" required>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-12 mb-1">
      <label>รายละเอียดสิทธิ์</label>
      <input type="text" class="form-control" name="description" placeholder="รายละเอียดสิทธิ์ ( Description )" required>
    </div>
  </div>

</form>
@endsection