<div class="panel-body ibox-content">
    <div class="col-12">
      <h3>รายละเอียดสาขา</h3>
      <div class="form-group">
        <label class="col-md-2 control-label">Code :</label>
        <div class="col-md-4 col-sm-12">
        <input class="form-control" name="code" type="text" value="{{ @$warehouse->code }}" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-2 control-label">ชื่อสาขา :</label>
        <div class="col-md-4 col-sm-12">
          <input class="form-control" name="name" type="text" value="{{ @$warehouse->name }}" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-2 control-label">Line name :</label>
        <div class="col-md-4 col-sm-12">
          <input class="form-control" name="line_name" value="{{ @$warehouse->line_name }}" type="text">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-2 control-label">Line Token :</label>
        <div class="col-md-4 col-sm-12">
          <input class="form-control" name="line_token" value="{{ @$warehouse->line_token }}" type="text">
        </div>
      </div>
      <div class="form-group">
        <label class="col-md-2 control-label">การเปิดทำการ :</label>
        <div class="col-md-4 col-sm-12">
          <select id="is_active" class="form-control" name="is_active" required>
            <option value="">กรุณาเลือก</option>
            <option value="1">เปิดทำการ</option>
            <option value="0">ปิดทำการ</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  @section('script')
  <script>
  $('#is_active').val('{{ @$warehouse->is_active }}')
  </script>
  @endsection