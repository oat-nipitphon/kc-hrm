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
    <strong>Role: {{ $role->name }}</strong>
  </li>
</ol>
@endsection
 
@section('content')
<div class="container">

  <div class="row">
    <div class="col-md-12 mb-1">
      <h1><strong>Role: {{ $role->name }}</strong></h1>
      <a href="{{route('roles.edit', $role->id)}}" class="btn btn-primary"><i class="fa fa-user-plus m-r-10"></i> แก้ไข Role</a>
      <a href="{{ route('roles.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i> ย้อนกลับ</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 mb-1">
      <hr>
      <label>ชื่อสิทธิ์ ( Display Name) : {{ $role->display_name }}</label><br>
      <label>รายละเอียดสิทธิ์ : {{ $role->description }}</label>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12 mb-1">
      <h1><strong>Permissions:</strong></h1>
      <ul>
        @foreach ($role->permissions as $r)
        <li>{{ $r->name }}<em class="m-l-15">({{ $r->description }})</em></li>
        @endforeach
      </ul>
      <hr class="m-t-0">
      <form action="{{action('RoleController@destroy', $role->id)}}" method="post">
        @csrf
        <input name="_method" type="hidden" value="DELETE">
        <button class="btn btn-danger">DELETE</button>
      </form>
    </div>
  </div>

</div>
@endsection