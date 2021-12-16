<div class="ibox-content">
    <form method="get" class="form-horizontal">
        @isset($employee->user->name)
        <div class="form-group"><label class="col-lg-2 control-label">Name</label>

            <div class="col-lg-10">
                <p class="form-control-static">{{$employee->user->name}}</p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-2 control-label">UserName</label>

            <div class="col-lg-10">
                <p class="form-control-static">{{$employee->user->username}}</p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-2 control-label">Email</label>

            <div class="col-lg-10">
                <p class="form-control-static">{{$employee->user->email}}</p>
            </div>
        </div>
        @endisset
        <div class="form-group"><label class="col-lg-2 control-label">รหัสพนักงาน</label>
            <div class="col-lg-10">
                <p class="form-control-static">{{$employee->emp_id}}</p>
            </div>
        </div>
        @empty($employee->user->name)
        <div class="form-group"><label class="col-lg-2 control-label">Username</label>
            <div class="col-lg-10">
                <p class="form-control-static">ไม่ได้เชื่อมต่อ UserName</p>
            </div>
        </div>
        @endempty
        <div class="form-group">
            <label class="col-lg-2 control-label">รูปโปรไฟล์พนักงาน</label>
            <div class="col-md-3 col-sm-12">
                @if($employee->image)
                <img width="100%" src="{{ asset("storage/".$employee->image) }}" alt="emp-profile">
                @else
                <img width="100%" src="https://via.placeholder.com/250" alt="emp-profile">
                @endif
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-2 control-label">สถานะ</label>
            <div class="col-lg-10">
            <p class="form-control-static btn text-{{$employee->activecss}}">{{ $employee->active_name}}</p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-2 control-label">ชื่อ - นามสกุล</label>
            <div class="col-lg-10">
                <p class="form-control-static">{{$employee->title_name->name}} {{$employee->th_firstname}}
                    {{$employee->th_lastname}}</p>
                <p class="form-control-static">{{$employee->en_firstname}} {{$employee->en_lastname}}</p>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-2 control-label">วันเกิด</label>
            <div class="col-lg-10">
                <p class="form-control-static">
                    {{$employee->date_of_birth}}
                </p>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-2 control-label">สถานภาพ</label>
            <div class="col-lg-10">
                <p class="form-control-static">
                    {{$employee->relationname}}
                </p>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-2 control-label">เพศ</label>
            <div class="col-lg-10">
                <p class="form-control-static">
                    {{$employee->sexname}}
                </p>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-2 control-label">เบอร์โทรศัพท์</label>
            <div class="col-lg-10">
                <p class="form-control-static">
                    {{$employee->tel_number}}
                </p>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-2 control-label">Email</label>
            <div class="col-lg-10">
                <p class="form-control-static">
                    {{$employee->email_address}}
                </p>
            </div>
        </div>          
        <div class="form-group"><label class="col-lg-2 control-label">สัญชาติ</label>
            <div class="col-lg-10">
                <p class="form-control-static">
                    {{$employee->national}}
                </p>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-2 control-label">เลขประจำตัวประชาชน/หนังสือเดินทาง</label>
            <div class="col-lg-10">
                <p class="form-control-static">
                    {{$employee->id_passport}}
                </p>
            </div>
        </div>
    </form> 

</div>