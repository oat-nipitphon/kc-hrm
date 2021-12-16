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
                <th>สถานะ</th>
                <th>หมายเหตุ</th>
            
                <th>อนุมัติโดย</th>
         
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $req)
            <tr>
                <td>{{$req->id}}</td>
                <td>
                    @if($req->request_type === 'OT')
                     <span class="badge badge-info">ขอ OT</span>
                    @else
                    <span class="badge badge-warning">ขาด ลา มาสาย</span>                                            
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
                <td>
                    @if($req->status == 1)
                        <span class="badge badge-warning">รออนุมัติ</span>
                    @elseif($req->status == 2)
                        <span class="badge badge-primary">อนุมัติเรียบร้อย</span>
                    @else
                        <span class="badge badge-danger">ไม่อนุมัติ</span>
                    @endif
                </td>
                <td>{{$req->remark}}</td>
                <td>
                    @if($req->approve_by)
                    {{$req->approves->name}}
                    @else
                    -
                    @endif    
                </td>
                                                 
            </tr>
            @endforeach                                    
        </tbody>
    </table>
</div>