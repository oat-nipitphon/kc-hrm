@extends('layouts.app')

@section('breadcrumb')
<h2>รายละเอียด</h2>
<ol class="breadcrumb">
    <li>
        <a href="{{route('employees.index')}}"><strong>หน้าหลัก</strong></a>
    </li>
    <li class="active">
        <strong>รายละเอียด</strong>
    </li>
</ol>
@endsection

@section('content')


<div class="row wrapper border-bottom white-bg page-heading">
    <div class="ibox-content">
        <div class="ibox">
            <h3>รายละเอียด</h3>
        </div>
        <form action="{{action('EmployeeController@destroy', $employee->id)}}" method="post">
            <div class="btn-group">
                <a class="btn btn-warning" href="{{ route('employees.edit',$employee->id) }}">แก้ไข</a>
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">เปลี่ยนสถานะ</button>
                @empty($employee->user->name)
                <a class="btn btn-primary" href="{{ route('employee.users.create',$employee->id)}}">เชื่อมต่อ User</a>
                @endempty
                <a class="btn btn-success" href="{{ route('employees.index') }}">กลับ</a>
            </div>
        </form>
    </div>

    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#emp-profile" aria-controls="emp-profile" role="tab" data-toggle="tab" aria-expanded="true">ข้อมูลพนักงาน</a>
        </li>
        <li role="presentation">
            <a href="#emp-guest" aria-controls="emp-guest" role="tab" data-toggle="tab">บุคคนอื่นๆ</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="emp-profile">
            @include('employees.contents.emp-profile')
        </div>
        <div role="tabpanel" class="tab-pane" id="emp-guest">
            @include('employees.contents.emp-guest')
        </div>
    </div>

   
</div>
@endsection
