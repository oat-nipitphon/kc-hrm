@extends('layouts.app') 
@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
  <li>
    <a href="#">หน้าหลัก</a>
  </li>
  <li class="active">
    <strong>ตั้งค่า Permission</strong>
  </li>
</ol>
@endsection
 
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>ตั้งค่า Permission</h1>
      <a href="{{ route('permissions.create') }}" class="btn btn-primary"><i class="fa fa-user-plus m-r-10"></i> สร้าง Permission (Create New Permission)</a>      {{-- <a href="{{route('permissions.create')}}" class="btn btn-primary"><i class="fa fa-user-plus m-r-10"></i> กำหนดสิทธิ์ใหม่ (Create New Permission)</a>      --}}
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
            <th class="text-center">ชื่อการเข้าถึง</th>
            <th class="text-center">แสดงข้อมูล</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($permissions as $permission)
          <tr>
            <td>
              {{ $permission->id }}
            </td>
            <td>
              {{ $permission->display_name }}
            </td>
            <td>
              <a href="{{ route('permissions.show',$permission->id)}}" class="btn btn-info">แสดงข้อมูล</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection