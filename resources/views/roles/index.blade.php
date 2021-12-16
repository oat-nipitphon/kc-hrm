@extends('layouts.app') 
@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
  <li>
    <a href="#">หน้าหลัก</a>
  </li>
  <li class="active">
    <strong>ตั้งค่า Role</strong>
  </li>
</ol>
@endsection
 
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>ตั้งค่า Role</h1>
      <a href="{{route('roles.create')}}" class="btn btn-primary"><i class="fa fa-user-plus m-r-10"></i> สร้าง Role (Create New Role)</a>
    </div>
  </div>
</div>

<hr class="m-t-0">

<div class="row">
  <div class="col-md-12">
    <div class="table-responsive text-center">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th class="text-center">ลำดับ</th>
            <th class="text-center">ชื่อสิทธิ์</th>
            <th class="text-center">แสดงข้อมูล</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($roles as $role)
          <tr>
            <td>
              {{ $role->id }}
            </td>
            <td>
              {{ $role->name }}
            </td>
            <td>
              <a href="{{ route('roles.show',$role->id)}}" class="btn btn-info">แสดงข้อมูล</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection