<div class="card-header">
    <h5 class="card-title"><h3>พนักงานสาขา {{$warehouse->name}} ({{$warehouse->code}})</h3></h5>
    <div class="btn-group" role="group" aria-label="Basic example">
      <a class="btn btn-success" id="warehouse-add-emp"><i class="fa fa-plus"></i> เพิ่มพนักงานเข้าสาขา</a>
    </div>
</div>
<div class="card-body">
  <div id="wrapper">
    <div class="col-6">
      <div class="card">
        <div class="card-body">            
          <div class="table-responsive" style="margin-top:25px;">
            <table class="table table-sm table-responsive" id="w-employee-table" style="width:100%;">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>ชื่อ - นามสกุล</th>
                  <th>ตำแหน่งงาน</th>
                  <th>แผนกงาน</th>
                  <th>ฝ่ายงาน</th>
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

<div class="modal fade" id="warehouse-emp-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">เพิ่มพนักงานสำหรับ {{$warehouse->name}} ({{$warehouse->code}})</h4>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                  <table class="table table-sm table-responsive" id="w-add-employee-table" style="width:100%;">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>ชื่อ - นามสกุล</th>
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


  <div class="modal fade" id="warehouse-position-emp-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">เพิ่มพนักงานสำหรับ {{$warehouse->name}} ({{$warehouse->code}})</h4>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                  <table class="table table-sm table-responsive" id="warehouse_posision_employee_table" style="width:100%;">
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
