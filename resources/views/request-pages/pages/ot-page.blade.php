
  @csrf
<div class="row wrapper border-bottom white-bg page-heading" id="contents" style="padding:15px">
    <div class="card-body">
        <div id="wrapper">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h3><span id="titles"></span></h3>
                </div>
                <div class="col-md-12 col-sm-12">
                    <hr style="margin:0px">
                </div>
                <div class="col-md-6 col-sm-12" style="padding-top:10px;">
                    <div class="form-group">
                        <label>ประเภท</label>
                        <select id="ot-list" name="request_id" class="form-control">
                            <option value="">กรุณาเลือก</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="change-date">
                            <option value="date">วัน</option>
                            <option value="datetime-local">วัน และ เวลา</option>
                        </select>
                    </div>           
                    <div class="form-group">
                        <label>เริ่มวันที่</label>
                        <input class="form-control" id="start_time" name="start_time" type="date">
                    </div>
                    <div class="form-group">
                        <label>สิ้นสุดวันที่</label>
                        <input class="form-control" id="end_time" name="end_time" type="date">
                    </div>
                    <div class="form-group">
                        <label>รูปภาพ</label>
                        <input class="form-control" type="file" name="images[]" multiple>
                    </div>
                    <div class="form-group">
                        <label>หมายเหตุ</label>
                        <textarea class="form-control" name="remark" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12" style="padding-top:10px;">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label><i class="fas fa-user"></i> รายชื่อพนักงาน</label>
                            </div>
                            <div class="col-md-6 col-sm-6 text-right">
                                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#employee-show"><i class="fas fa-plus"></i> เพิ่มพนักงาน</button>
                                        <button type="button" class="btn btn-sm btn-danger" onclick="rem_employee()"><i class="fas fa-minus"></i> เคลียข้อมูล</button>
                            </div>
                        </div>                     
                        <table class="table table-sm table-responsive table-striped" style="width:100%;">
                            <thead>
                              <tr>
                                <th>รหัสพนักงาน</th>
                                <th>ชื่อ - นามสกุล</th>
                              </tr>
                            </thead>
                            <tbody id="employees-list">
                                
                            </tbody>
                          </table> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container text-center">
        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
    </div>
</div>


<div class="modal fade" id="employee-show" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">รายชื่อพนักงาน</h4>
        </div>
        <div class="modal-body">
            <table class="table table-sm table-responsive table-striped" id="employees-table" style="width:100%;">
                <thead>
                  <tr>
                    <th>สถานะ</th>
                    <th>รหัสพนักงาน</th>
                    <th>ประเภทพนักงาน</th>
                    <th>ชื่อ - นามสกุล</th>
                    <th>ตำแหน่ง</th>
                    <th>จัดการ</th>
                  </tr>
                </thead>
                <tbody>                    
                </tbody>
              </table> 
        </div>
      </div>
    </div>
  </div>
<script>
    $('#titles').text(xText);
    $('#change-date').change(function(){
        $('#start_time').attr('type',$(this).val());
        $('#end_time').attr('type',$(this).val());
    });
</script>