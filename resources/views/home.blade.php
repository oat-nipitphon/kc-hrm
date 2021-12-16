@extends('layouts.app')

@section('breadcrumb')
    <h2>หน้าหลัก</h2>
    <ol class="breadcrumb">
        {{--<li>--}}
            {{--<a href="index.html">หน้าหลัก</a>--}}
        {{--</li>--}}
        <li class="active">
            <strong>หน้าหลัก</strong>
        </li>
    </ol>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <!-- in -->


                    <!-- You are logged in! -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>


</script>

