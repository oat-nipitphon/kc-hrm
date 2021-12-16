<div class="ibox-content" style="border: none;">
    <div class="form-group text-center" id="positions-area">
        <button type="button" data-toggle="modal" data-target="#position-modal" class="btn btn-primary"><i class="fas fa-plus"></i> เพิ่มข้อมูลสาขา ตำแหน่ง แผนกงาน</button>
    </div>
</div>


<div class="modal fade" id="position-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label>สาขา</label>
                <select class="form-control selectpicker" data-live-search="true" name="warehouses" id="warehouses">
                    <option value="0">กรุณาเลือกสาขา</option>
                    @foreach ($warehouses as $warehouse)
                    <option value="{{$warehouse->id}}">{{$warehouse->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <table class="table table-striped table-responsive" id="warehouses_position_table" style="width:100%;">
                    <thead>
                        <tr>
                            <th>ตำแหน่งงาน</th>
                            <th>แผนกงาน</th>
                            <th>ฝ่ายงาน</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>


