@extends('layouts.app') 
@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
    <li>
        <a href="#">หน้าหลัก</a>
    </li>
    <li>
        <a href="{{ route('users.index') }}">Manage Users</a>
    </li>
    <li>
        <a href="{{ route('users.show',$user->id) }}">{{ $user->name }}</a>
    </li>
    <li class="active">
        <strong>Edit User {{ $user->name }}</strong>
    </li>
</ol>
@endsection
 
@section('content')
<div class="row">
    <div class="col-12">
        <form action="{{route('users.update', $user->id)}}" method="POST">
            {{ method_field('PUT') }} {{csrf_field()}}


            <div class="form-row">
                <div class="col-md-12 mb-1">
                    <h1>Edit User {{ $user->name }}</h1>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> บันทึกผู้ใช้</button>
                    <a href="{{route('users.index')}}" class="btn btn-danger"><i class="fa fa-undo"></i> ย้อนกลับ</a>
                    <hr class="m-t-0">
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-1">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Name" required>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-1">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="{{ $user->username }}" disabled required>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-1">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email }}" disabled required>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12">
                    <div class="radio">
                        <div class="col-md-12 mt-1">
                            <label><input type="radio" name="password_options" value="keep"> Do Not Change Password</label><br>
                            <label>
                                <input type="radio" name="password_options" value="manual">
                                    Manually Set New Password
                                <input type="text" class="form-control input mt-1" name="password" id="password" if="password_options == 'manual'" placeholder="Manually give a password to this user">
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="col-md-12 mb-1">
                    <h1><strong>Role:</strong></h1>
                    @foreach ($roles as $role)
                    <div class="checkbox">
                        <label><input type="checkbox" {{ $user->hasRole($role->name) == true ? "checked" : "" }} name="role[]" value="{{ $role->name }}">{{$role->display_name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var app = new Vue({
        el: '#app',
        data: {
            password_options: 'keep'
        }
        });

</script>
@endsection