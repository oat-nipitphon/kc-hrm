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

<div class="container">
 <div class="row wrapper border-bottom white-bg page-heading">

    <!-- in -->

    <div class="ibox-content">
        <div class="ibox">
            <h3>รายละเอียด</h3>
        </div>
        <form action="{{action('EmployeeController@destroy', $employees->id)}}" method="post">
            <div class="btn-group" >
                <a class="btn btn-warning" href="{{ route('employees.edit',$employees->id) }}">แก้ไข</a>
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger" type="submit">เปลี่ยนสถานะ</button>
                @empty($employees->user->name)
                <a class="btn btn-primary" href="{{ route('employee.users.create',$employees->id)}}">เชื่อมต่อ User</a>
                @endempty
                <a class="btn btn-success" href="{{ route('employees.index') }}">กลับ</a>
            </div>
        </form>        
    </div>

    <div class="ibox-content">
        <form method="get" class="form-horizontal">

            @isset($employees->user->name)
            <div class="form-group"><label class="col-lg-2 control-label">Name</label>

                <div class="col-lg-10"><p class="form-control-static">{{$employees->user->name}}</p></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-lg-2 control-label">UserName</label>

                <div class="col-lg-10"><p class="form-control-static">{{$employees->user->username}}</p></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-lg-2 control-label">Email</label>

                <div class="col-lg-10"><p class="form-control-static">{{$employees->user->email}}</p></div>
            </div>
            @endisset

         

            @empty($employees->user->name)
            <div class="form-group"><label class="col-lg-2 control-label">User Name</label>
                <div class="col-lg-10"><p class="form-control-static">ไม่ได้เชื่อมต่อ UserName</p></div>
            </div>
            @endempty

               
            <div class="form-group">
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <img width="100%" src="{{ asset("storage/".$employees->image) }}" alt="emp-profile">
                </div>
            </div>

            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-lg-2 control-label">สถานะ</label>

                <div class="col-lg-10"><p class="form-control-static">{{ ($employees->active_name) }}</p></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-lg-2 control-label">ชื่อ</label>

                <div class="col-lg-10"><p class="form-control-static">{{$employees->th_firstname}}</p></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-lg-2 control-label">นามสกุล</label>

                <div class="col-lg-10"><p class="form-control-static">{{$employees->th_lastname}}</p></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-lg-2 control-label">Name</label>

                <div class="col-lg-10"><p class="form-control-static">{{$employees->en_firstname}}</p></div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group"><label class="col-lg-2 control-label">Last Name</label>

                <div class="col-lg-10"><p class="form-control-static">{{$employees->en_lastname}}</p></div>
            </div>
        </form>
    </div>

</div>
@endsection
