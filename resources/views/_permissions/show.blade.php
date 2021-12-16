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
    <strong>Permission: {{ $permission->name }}</strong>
  </li>
</ol>
@endsection
 
@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-12 mb-1">
      <h1><strong>Permission: {{ $permission->name }}</strong></h1>
      <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-primary"><i class="fa fa-user-plus m-r-10"></i> แก้ไข Permission</a>
      <a href="{{ route('permissions.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i> ย้อนกลับ</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 mb-1">
      <hr>
      <label>ชื่อการเข้าถึง ( Display Name) : {{ $permission->display_name }}</label><br>
      <label>รายละเอียดการเข้าถึง : {{ $permission->description }}</label>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 mb-1">
      <h1><strong>Permissions:</strong></h1>
      <ul>
        <li>{{ $permission->name }}</li>
      </ul>
      <hr class="m-t-0">
      <form action="{{action('PermissionController@destroy', $permission->id)}}" method="post">
        @csrf
        <input name="_method" type="hidden" value="DELETE">
        <button class="btn btn-danger">DELETE</button>
      </form>
    </div>
  </div>

</div>
@endsection