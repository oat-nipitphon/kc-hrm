<div class="card-header">
  <h5 class="card-title"><h3>กำลังคนประจำสาขา {{$warehouse->name}} ({{$warehouse->code}})</h3></h5>
</div>
<div class="card-body">
  <div id="wrapper">
    <div class="col-6">
      <div class="card">
        <div class="card-body">
          <div style="margin-top:25px;">
            <table class="table table-sm table-responsive" id="w-manpower-table" style="width:100%;">
              <thead>
                <tr>
                  <th>ตำแหน่ง</th>
                  <th>แผนก</th>
                  <th>ฝ่ายงาน</th>
                  <th>กำลังคน</th>
                  <th>ความต้องการ</th>
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
</div>

<div class="modal fade" id="manpower-emp-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">เพิ่มข้อมูลสำหรับ {{$warehouse->name}} ({{$warehouse->code}})</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
          <label>จำนวนที่ต้องการ</label>
          <input type="text" class="form-control" id="manpower-value">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="save-manpower" class="btn btn-success btn-sm">บันทึก</button>
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>