@extends('layouts.app')
@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
    <li>
        <a href="#">หน้าหลัก</a>
    </li>
    <li class="active">
        <a href="{{ route('users.index') }}">Manage Users</a>
    </li>
        <li class="active">
        <strong>Create New User</strong>
    </li>
</ol>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{ route('users.store') }}" method="POST">
            {{csrf_field()}}

            <div class="form-row">
                <div class="col-md-12 mb-1">
                    <h1 class="title">Create New User</h1>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> บันทึกข้อมูลผู้ใช้</button>
                    <a href="{{route('users.index')}}" class="btn btn-danger"><i class="fa fa-undo"></i> ย้อนกลับ</a>
                    <hr class="m-t-0">
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-1">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-1">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-1">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-12 mb-1">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection