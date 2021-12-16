@extends('layouts.app') 
@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
    <li>
        <a href="#">หน้าหลัก</a>
    </li>
    <li class="active">
        <strong>Manage Users</strong>
    </li>
</ol>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Manage Users</h1>
            <a href="{{route('users.create')}}" class="btn btn-primary"><i class="fa fa-user-plus m-r-10"></i> สร้างผู้ใช้ใหม่</a>
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
                        <th class="text-center">ชื่อผู้ใช้</th>
                        <th class="text-center">อีเมล์</th>
                        <th class="text-center">สิทธิ์ผู้ใช้</th>
                        <th class="text-center">แสดงข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <th>{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            {{ $user->roles->count()==0?'This user has not been assigned any roles yet':'' }}
                            @foreach ($user->roles as $role) 
                            <a>{{ $role->display_name }}</a>
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{route('users.show', $user->id)}}">แสดงข้อมูล</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<center>
    {{$users->links()}}
</center>
@endsection

