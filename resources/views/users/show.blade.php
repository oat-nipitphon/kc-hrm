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
    <li class="active">
        <strong>{{ $user->name }}</strong>
    </li>
</ol>
@endsection
 
@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-12 mb-1">
            <h1><strong>User: {{ $user->name }}</strong></h1>
            <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary"><i class="fa fa-user-plus m-r-10"></i> แก้ไขผู้ใช้</a>
            <a href="{{ route('users.index') }}" class="btn btn-warning"><i class="fa fa-undo"></i> ย้อนกลับ</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-1">
            <hr>
            <h1><strong>Details:</strong></h1>
            <label>Name : {{ $user->name }}</label><br>
            <label>Username : {{ $user->username }}</label><br>
            <label>E-Mail: {{ $user->email }}</label>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-1">
            <h1><strong>Role:</strong></h1>
            <ul>
                {{$user->roles->count() == 0 ? 'This user has not been assigned any roles yet' : ''}} @foreach ($user->roles as $role)
                <li>{{$role->display_name}} ({{$role->description}})</li>
                @endforeach
            </ul>
            <hr class="m-t-0">
            <form action="{{action('UserController@destroy', $user->id)}}" method="post">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-danger">DELETE</button>
            </form>
        </div>
    </div>

</div>
@endsection