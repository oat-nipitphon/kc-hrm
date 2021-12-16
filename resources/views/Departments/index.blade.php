@extends('layouts.app') 
@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
  <li>
    <a href="#">หน้าหลัก</a>
  </li>
  <li class="active">
    <strong>จัดการสาขา</strong>
  </li>
</ol>
@endsection

@section('content')


<div class="row">
     <div class="col-md-10">
       <br>
       <div class="container">
            <h3>จัดการสาขา</h3>
        </div>
      </div>

        <div class="col-md-2">
        <div class="pull-left">
          <br>
            <a href="{{route('departments.create')}}" class="btn btn-primary"><i class="fa fa-user-plus m-r-10"></i> สร้างสาขาใหม่</a>
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
            <th class="text-center">Code</th>
            <th class="text-center">Name</th>
            <th class="text-center">เปิดทำการ</th>
            <th class="text-center">แสดงข้อมูล</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($departments as $department)
          <tr>
            <td>
              {{ $department->id }}
            </td>
            <td>
              {{ $department->code }}
            </td>
            <td>
              {{ $department->name }}
            </td>
            <td>
                {{ ($department->is_active) == 1 ? "เปิดทำการ" : "ปิดทำการ" }}
            </td>
            <td>
              <a href="{{ route('departments.show',$department->id)}}" class="btn btn-success">แสดงข้อมูล</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection