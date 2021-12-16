@extends('layouts.app')
@section('breadcrumb')

<h2>สร้างสาขาใหม่</h2>
<ol class="breadcrumb">
  <li>
    <a href="#">หน้าหลัก</a>
  </li>
  <li>
    <a href="{{ route('warehouses.index') }}">จัดการสาขา</a>
  </li>
  <li class="active">
    <strong>สร้างสาขาใหม่</strong></a>
  </li>
</ol>

@endsection

@section('content')

<div class="panel panel-default" style="border:none!important;">
  <form class="form-horizontal" action="{{route('warehouses.store')}}" method="POST">
    @csrf
    <div class="panel-body">
      <div class="col-12">
        <h5>สร้างสาขาใหม่</h5>
      </div>
      <div class="col-12">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> บันทึกสาขาใหม่</button>
        <a href="{{ route('warehouses.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i> ย้อนกลับ</a>
      </div>
    </div>

    @include('warehouses.form')

  </form>
</div>








@endsection