@extends('layouts.app')

@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
    <li class="active">
        <strong>หน้าหลัก</strong>
    </li>
</ol>
@endsection

@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="card-header">
        <h5 class="card-title">
            <h3>จัดการข้อมูล OT ขาด ลา มาสาย</h3>
        </h5>
    </div>
    <div class="card-body">
        <div id="wrapper">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#emp-profile" aria-controls="emp-profile" role="tab" data-toggle="tab" aria-expanded="true">ขอ OT</a>
                            </li>
                            <li role="presentation">
                                <a href="#emp-guest" aria-controls="emp-guest" role="tab" data-toggle="tab">ขาด ลา มาสาย</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="emp-profile">
                                <div class="table-responsive" style="margin-top:25px;">
                                    <table class="table table-sm table-striped" id="worktime_Table" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th>ประเภท</th>
                                                <th>เวลาเริ่ม</th>
                                                <th>เวลาสิ้นสุด</th>
                                                <th>พนักงาน</th>
                                                <th>ผู้ขอ</th>
                                                <th>วันที่ทำรายการ</th>
                                                <th>หมายเหตุ</th>
                                                <th>สถานะ</th>
                                                <th>อนุมัติโดย</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_ot as $req)
                                            <tr>
                                                <td>{{$req->id}}</td>
                                                <td>
                                                    @if($req->request_id)
                                                    <span class="badge badge-info">{{$req->ot->name}}</span>                                           
                                                    @endif
                                                </td>
                                                <td>{{$req->start_time}}</td>
                                                <td>{{$req->end_time}}</td>
                                                <td>
                                                    {{$req->employee->emp_id}}<br>
                                                    {{$req->employee->th_firstname}} {{$req->employee->th_lastname}}
                                                </td>
                                                <td>{{$req->user->name}}</td>
                                                <td>{{$req->created_at}}</td>
                                               
                                                <td>{{$req->remark}}</td>
                                                <td>
                                                    @if($req->status == 1)
                                                        <span class="badge badge-warning">รออนุมัติ</span>
                                                    @elseif($req->status == 2)
                                                        <span class="badge badge-primary">อนุมัติเรียบร้อย</span>
                                                    @else
                                                        <span class="badge badge-danger">ไม่อนุมัติ</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($req->approve_by)
                                                    {{$req->approves->name}}
                                                    @else
                                                    -
                                                    @endif    
                                                </td>
                                                <td>
                                                    @if($req->images)
                                                    <button class="btn btn-warning" onclick="checkImages({{$req->images}})">ดูรูปหลักฐาน</button>
                                                    @endif
                                                    <button class="btn btn-primary" onclick="approves({{$req->id}})">อนุมัติ</button>
                                                    <button class="btn btn-danger" onclick="unApproves({{$req->id}})">ไม่อนุมัติ</button>
                                                </td>                                        
                                            </tr>
                                            @endforeach                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="emp-guest">
                                <div class="table-responsive" style="margin-top:25px;">
                                    <table class="table table-sm table-striped" id="worktime_Table" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th>ประเภท</th>
                                                <th>เวลาเริ่ม</th>
                                                <th>เวลาสิ้นสุด</th>
                                                <th>พนักงาน</th>
                                                <th>ผู้ขอ</th>
                                                <th>วันที่ทำรายการ</th>
                                                <th>หมายเหตุ</th>
                                                <th>สถานะ</th>
                                                <th>อนุมัติโดย</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data_leave as $req)
                                            <tr>
                                                <td>{{$req->id}}</td>
                                                <td>
                                                    @if($req->request_id)
                                                    <span class="badge badge-info">{{$req->leave->name}}</span>                                           
                                                    @endif
                                                </td>
                                                <td>{{$req->start_time}}</td>
                                                <td>{{$req->end_time}}</td>
                                                <td>
                                                    {{$req->employee->emp_id}}<br>
                                                    {{$req->employee->th_firstname}} {{$req->employee->th_lastname}}
                                                </td>
                                                <td>{{$req->user->name}}</td>
                                                <td>{{$req->created_at}}</td>
                                               
                                                <td>{{$req->remark}}</td>
                                                <td>
                                                    @if($req->status == 1)
                                                        <span class="badge badge-warning">รออนุมัติ</span>
                                                    @elseif($req->status == 2)
                                                        <span class="badge badge-primary">อนุมัติเรียบร้อย</span>
                                                    @else
                                                        <span class="badge badge-danger">ไม่อนุมัติ</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($req->approve_by)
                                                    {{$req->approves->name}}
                                                    @else
                                                    -
                                                    @endif    
                                                </td>
                                                <td>
                                                    @if($req->images)
                                                    <button class="btn btn-warning" onclick="checkImages({{$req->images}})">ดูรูปหลักฐาน</button>
                                                    @endif                                                    
                                                    <button class="btn btn-primary" onclick="approves({{$req->id}})">อนุมัติ</button>
                                                    <button class="btn btn-danger" onclick="unApproves({{$req->id}})">ไม่อนุมัติ</button>
                                                </td>                                        
                                            </tr>
                                            @endforeach                                    
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="show-images-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body" id="show-images">
          
        </div>
      </div>
    </div>
  </div>


@endsection
@section('script')
<script>
   $('table').DataTable();
   approves = (id,check) => {
       Swal.fire({
           title: 'มั่นใจหรือไม่?',
           text: "ต้องการจะอนุมัติหรือไม่",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'อนุมัติ',
           cancelButtonText: 'ยกเลิก',
       }).then((result) => {
           if (result.value) {
                $.post("{{route('request-work-time.save_approve')}}", data = {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    approves: 'approve'
                },
                    function (res) {
                        if(res){
                            if (res) {
                               swal.fire('Success', 'บันทึกข้อมูลสำเร็จ', 'success').then((result) => {
                                   location.reload();
                               })
                           } 
                        }
                    },
                );
           }
       })
   }

   checkImages = (images) => {
    $('#show-images').empty();
    images.forEach(image => {
        $('#show-images').append(`
        <div class="col-md-12">
            <img src="{{ asset('/') }}/public/storage/${image}" style="width:100%">
        </div>
        `);
    });
    $('#show-images-modal').modal('show');
   }

   unApproves = (id,check) => {
       Swal.fire({
           title: 'มั่นใจหรือไม่?',
           text: "ต้องการจะไม่อนุมัติหรือไม่",
           icon: 'warning',
           showCancelButton: true,
           confirmButtonColor: '#3085d6',
           cancelButtonColor: '#d33',
           confirmButtonText: 'ไม่อนุมัติ',
           cancelButtonText: 'ยกเลิก',
           }).then((result) => {
               if (result.value) {
                $.post("{{route('request-work-time.save_approve')}}", data = {
                           _token: '{{ csrf_token() }}',
                           id: id,
                           approves: 'unApprove'
                       },
                       function (res) {
                           if (res) {
                               swal.fire('Success', 'บันทึกข้อมูลสำเร็จ', 'success').then((result) => {
                                   location.reload();
                               })
                           }
                       },
                   );
               }
           })
           }

</script>
@endsection