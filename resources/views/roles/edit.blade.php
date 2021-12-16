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
  <li>
    <a href="{{ route('roles.show',$role->id) }}">สิทธิ์ {{ $role->name }}</a>
  </li>
  <li class="active">
    <strong>แก้ไข Role {{ $role->name }}</strong>
  </li>
</ol>
@endsection
 
@section('content')
<div class="container">
  <form action="{{route('roles.update', $role->id)}}" method="POST">
    {{ csrf_field() }} {{ method_field('PUT') }}

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><strong>แก้ไข Role {{ $role->name }}</strong></h1>
          <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> บันทึก Role</button>
          <a href="{{ route('roles.show',$role->id) }}" class="btn btn-warning"><i class="fa fa-undo"></i> ย้อนกลับ</a>
        </div>
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-12 mb-1">
        <h1><strong>รายละเอียดสิทธิ์:</strong></h1>
        <label>ชื่อสิทธิ์ ( Display Name)</label>
        <input type="text" class="form-control" name="display_name" value="{{ $role->display_name }}" placeholder="{{ $role->display_name }}"
          required>
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-12 mb-1">
        <label>ชื่อสิทธิ์ (Can not be changed)</label>
        <input type="text" class="form-control" name="name" value="{{ $role->name }}" placeholder="{{ $role->name }}" disabled required>
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-12 mb-1">
        <label>รายละเอียดสิทธิ์</label>
        <input type="text" class="form-control" name="description" value="{{ $role->description }}" placeholder="{{ $role->description }}"
          required>
      </div>
    </div>

    <div class="form-row">
      <div class="col-md-12 mb-1">
        <h1><strong>Permissions:</strong></h1>
        @foreach ($permissions as $permission)
        <div class="checkbox">
          <label><input type="checkbox" {{ $role->hasPermission($permission->name) == true ? "checked" : "" }} name="permission[]" value="{{ $permission->name }}">{{$permission->display_name}}</label>
        </div>
        @endforeach
      </div>
    </div>

  </form>

</div><br>
@endsection