@extends('layouts.app') 
@section('breadcrumb')

<h2>สร้างสาขาใหม่</h2>
<ol class="breadcrumb">
  <li>
    <a href="#">หน้าหลัก</a>
  </li>
  <li>
    <a href="{{ route('departments.index') }}">จัดการสาขา</a>
  </li>
  <li class="active">
    <strong>สร้างสาขาใหม่</strong></a>
  </li>
</ol>

@endsection
 
@section('content')


<div class="col-md-10">
  <br>
  <h3>สร้างสาขาใหม่</h3>
</div>


<div class="col-md-2">
<br>
  <form action="{{route('departments.store')}}" method="POST">
  {{ csrf_field() }}
  <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> บันทึกสิทธิ์ใหม่</button>
  
  <a href="{{ route('departments.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i> ย้อนกลับ</a>

</div>

  <hr class="m-t-0">
  
  <br>
  <h1><strong>รายละเอียดสาขา:</strong></h1>

  <div class="col-md-12">
      <div class="col-md-2">
        <label>Code</label>
        <input type="text" class="form-control" name="code" required>
      </div>
    </div>

      <div class="col-md-12">
          <div class="col-md-2">
          <label>Name</label>
          <input type="text" class="form-control" name="name" required>
        </div>
    </div>

<div class="col-md-12">
    <div class="col-md-2">
        <label>สถานะ</label>
    <select class="form-control m-b" name="is_active" required>
        <option value="1">เปิดทำการ</option>
        <option value="0">ปิดทำการ</option>
    </select>
  </div>
</div>


    


@endsection