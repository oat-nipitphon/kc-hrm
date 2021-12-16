@extends('layouts.app')

@section('breadcrumb')
<h2>แก้ไข</h2>
<ol class="breadcrumb">
  <li>
    <a href="{{route('employees.index')}}"><strong>หน้าหลัก</strong></a>
  </li>
  <li>
    <a href="{{route('employees.show',$employee->id)}}"><strong>รายละเอียด</strong></a>
  </li>
  <li class="active">
    <strong>แก้ไข</strong>
  </li>
</ol>
@endsection

@section('content')

<div class="container">
  <div class="row wrapper border-bottom white-bg page-heading">

    <div class="row">
      <div class="col-lg-12">
        <div class="ibox float-e-margins">
          <div class="ibox-title">
            <div class="ibox">
              <h5>แก้ไข <small></small></h5>
            </div>
            <form method="post" class="form-horizontal" action="{{ route('employees.update',$employee->id) }}" >
              <input type="hidden" name="_method" value="PUT" />
              {{ csrf_field() }}

              
              <div class="ibox">
                <button class="btn btn-primary" type="submit">ยืนยัน</button>
                <a class="btn btn-success" href="{{ route('employees.update',$employee->id) }}">กลับ</a>
              </div>

              <div class="ibox-content">
                <div class="form-group"><label class="col-sm-2 control-label">ชื่อ</label>

                  <div class="col-sm-10"><input type="text" class="form-control" id="th_firstname" name="th_firstname" placeholder="ชื่อ" value="{{$employee->th_firstname}}" required></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">นามสกุล</label>

                  <div class="col-sm-10"><input type="text" class="form-control" id="th_lastname" name="th_lastname" placeholder="นามสกุล" value="{{$employee->th_lastname}}" required></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">First name</label>

                  <div class="col-sm-10"><input type="text" class="form-control" id="en_firstname" name="en_firstname" placeholder="First name" value="{{$employee->en_firstname}}" required"></div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group"><label class="col-sm-2 control-label">Last name</label>

                  <div class="col-sm-10"><input type="text" class="form-control" id="en_lastname" name="en_lastname" placeholder="Last name" value="{{$employee->en_lastname}}" required></div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

