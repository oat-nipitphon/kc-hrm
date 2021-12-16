@extends('layouts.app') 
@section('breadcrumb')
<h2>Show {{ $department->name }}</h2>
<ol class="breadcrumb">
  <li>
    <a href="#">หน้าหลัก</a>
  </li>
  <li>
    <a href="{{ route('departments.index') }}">จัดการสาขา</a>
  </li>
  <li>
    <strong>Show {{ $department->name }}</strong></a>
  </li>
</ol>
@endsection

@section('content')

      
<br>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('departments.edit',$department->id)}}" class="btn btn-warning">แก้ไข</a>
                <a href="{{ route('departments.index')}}" class="btn btn-warning">ย้อนกลับ</a>
            </div>   
        </div>
<br>

<hr class="m-t-0">
          
          <div class="col-md-12">
            <div class="col-md-4 mb-1">
              <label>Code</label>
              <input type="text" class="form-control" value="{{ $department->code }}" disabled>
            </div>
          </div>
        
          <div class="col-md-12">
                <div class="col-md-4 mb-1">
                  <label>Name</label>
                  <input type="text" class="form-control" value="{{ $department->name }}" disabled>
                </div>
          </div>

          <div class="col-md-12">
                <div class="col-md-4 mb-1">
                  <label>สถานะ</label>
                  <input type="text" class="form-control" value="{{ $department->active_name }}" disabled>
                </div>
          </div>
      
          <div class="col-md-12">
            <br>
          <div>
              <form action="{{route('departments.destroy', $department->id)}}" method="post">
                  @csrf
              <input name="_method" type="hidden" value="DELETE">
              <button class="btn btn-success" type="submit">เปลี่ยนสถานะ</button>
              </form>
          </div>
        </div>
@endsection