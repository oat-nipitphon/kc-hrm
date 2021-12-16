<div class="panel-body ibox-content">
    <div class="col-12">
      <h3>รายละเอียดสาขา</h3>
      <div class="form-group">
        <label class="col-md-2 text-right">Code :</label>
        <div class="col-md-4 col-sm-12">
        <span>{{$warehouse->code}}</span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-2 text-right">ชื่อสาขา :</label>
        <div class="col-md-4 col-sm-12">
          <span>{{$warehouse->name}}</span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-2 text-right">Line name :</label>
        <div class="col-md-4 col-sm-12">
          <span>{{$warehouse->line_name}}</span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-2 text-right">Line Token :</label>
        <div class="col-md-4 col-sm-12">
          <span>{{$warehouse->line_token}}</span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-2 text-right">การเปิดทำการ :</label>
        <div class="col-md-4 col-sm-12">         
            @if($warehouse->is_active == 1) 
              <span class="badge badge-primary">เปิดบริการ</span>
            @else
            <span class="badge badge-danger">ปิดบริการ</span>
            @endif          
        </div>
      </div>
    </div>
  </div>