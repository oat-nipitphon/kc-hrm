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
    <strong>แก้ไขสาขา</strong></a>
  </li>
</ol>

@endsection

@section('content')

<div class="panel panel-default" style="border:none!important;">
  <form class="form-horizontal" action="{{ route('warehouses.update',$warehouse->id) }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT" />
    @csrf
    <div class="panel-body">
      <div class="col-12">
        <h5>แก้ไชสาขา</h5>
      </div>
      <div class="col-12">
        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> แก้ไขสาขา</button>
        <a href="{{ route('warehouses.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i> ย้อนกลับ</a>
      </div>
    </div>

    @include('warehouses.form')

  </form>
</div>








@endsection