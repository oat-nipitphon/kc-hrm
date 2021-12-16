<div class="ibox-content">
    <form method="get" class="form-horizontal">
        @foreach ($empguests as $guest)
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <h3 class="form-control-static">{{$guest->rule}}</h3>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-2 control-label">ชื่อ - นามสกุล</label>
            <div class="col-lg-10">
                <p class="form-control-static">{{$guest->firstname}} {{$guest->lastname}}</p>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-2 control-label">ความเกี่ยวข้อง</label>
            <div class="col-lg-10">
                <p class="form-control-static">{{$guest->relative}}</p>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        @endforeach
        
    </form> 

</div>