<div class="card-header">
    <h5 class="card-title"><h3>รายชื่อตำแหน่งงาน</h3></h5>
    <div class="btn-group" role="group" aria-label="Basic example">
      <a class="btn btn-success" id="position-emp-create"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a>
    </div>
</div>
<div class="card-body">
  <div id="wrapper">
    <div class="col-6">
      <div class="card">
        <div class="card-body">            
          <div class="table-responsive" style="margin-top:25px;">
            <table class="table table-sm table-responsive" id="warehouses_position_table" style="width:100%;">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th>ตำแหน่งงาน</th>
                  <th>แผนกงาน</th>
                  <th>ฝ่ายงาน</th>
                  {{-- <th></th> --}}
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

<div class="modal fade" id="position-emp-modal" tabindex="-1" role="dialog">
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
                  <table class="table table-sm table-responsive" id="w_position_table" style="width:100%;">
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
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
