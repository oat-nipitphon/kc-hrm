@extends('layouts.app') 
@section('breadcrumb')
<h2>แก้ไขข้อมูล {{ $department->name }}</h2>
<ol class="breadcrumb">
  <li>
    <a href="#">หน้าหลัก</a>
  </li>
  <li>
    <a href="{{ route('departments.index') }}">จัดการสาขา</a>
  </li>
  <li>
      <a href="{{ route('departments.show',$department->id) }}">Show {{ $department->name }}</a>
    </li>
  <li class="active">
    <strong>แก้ไขข้อมูล {{ $department->name }}</strong>
  </li>
</ol>
@endsection
 
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1><strong>แก้ไขสาขา {{ $department->name }}</strong></h1>
    </div>
  </div>
</div>

<form action="{{route('departments.update', $department->id)}}" method="POST">
  {{ csrf_field() }} {{ method_field('PUT') }}

  <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> บันทึก</button>
  <a href="{{route('departments.show', $department->id)}}" class="btn btn-warning"><i class="fa fa-undo"></i> ย้อนกลับ</a>

  <hr class="m-t-0">

  <h1><strong>รายละเอียดสาขา:</strong></h1>

  <div class="col-md-12">
    <div class="col-md-4 mb-1">
      <label>Code</label>
      <input type="text" class="form-control" name="code" value="{{ $department->code }}" required>
    </div>
  </div>

  <div class="col-md-12">
    <div class="col-md-4 mb-1">
      <label>Name</label>
      <input type="text" class="form-control" name="name" value="{{ $department->name }}" required>
    </div>
  </div>

  
</form>
@endsection