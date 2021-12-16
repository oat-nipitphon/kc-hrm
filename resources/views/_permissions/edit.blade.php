@extends('layouts.app') 
@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
  <li>
    <a href="#">หน้าหลัก</a>
  </li>
  <li>
    <a href="{{ route('permissions.index') }}">ตั้งค่าการเข้าถึง</a>
  </li>
  <li class="active">
    <strong>แก้ไข Permission</strong>
  </li>
</ol>
@endsection
 
@section('content')

<form action="{{route('permissions.update', $permission->id)}}" method="POST">
  {{ csrf_field() }} {{ method_field('PUT') }}

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1><strong>แก้ไข Permission</strong></h1>
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> บันทึก Permission</button>
        <a href="{{ route('permissions.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i> ย้อนกลับ</a>
      </div>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-12 mb-1">
      <h1><strong>รายละเอียดการเข้าถึง:</strong></h1>
      <label>ชื่อการเข้าถึง ( Display Name)</label>
      <input type="text" class="form-control" name="display_name" value="{{ $permission->display_name }}" placeholder="ชื่อการเข้าถึง ( Display Name )" required>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-12 mb-1">
      <label>ชื่อการเข้าถึง (Can not be changed)</label>
      <input type="text" class="form-control" name="name" value="{{ $permission->name }}" placeholder="ชื่อการเข้าถึง ( Can not be changed )" disabled required>
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-12 mb-1">
      <label>รายละเอียดการเข้าถึง</label>
      <input type="text" class="form-control" name="description" value="{{ $permission->description }}" placeholder="รายละเอียดการเข้าถึง ( Description )" required>
    </div>
  </div>

</form>
@endsection