<div class="ibox-content">

    <div class="form-group">
      <div class="row">
        <div class="col-sm-3">
          <img style="cursor:pointer;width:100%;max-height:250px;" class="btn-block upload-image"
            id="emp-preview-profile" src="https://via.placeholder.com/250" alt="emp-preview-profile">
          <button type="button" class="btn btn-info btn-block upload-image">เลือกรูปภาพพนักงาน</button>
          <input style="display:none;" type="file" name="emp_image" id="emp_image">
        </div>
        <div class="col-sm-9">
          <div class="form-group">
            <div class="col-lg-3 col-md-3 col-sm-12">
              <label>คำนำหน้า</label>
              <select class="form-control selectpicker" data-live-search="true" name="title" id="title"
                required>
                <option value="">กรุณาเลือก</option>
                @foreach ($titles as $title)
                <option value="{{$title->id}}">{{$title->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12" id="date-picker">
              <label>วันเกิด</label>
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="ปี/เดือน/วัน">
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <label>สถานภาพ</label>
              <select class="form-control selectpicker" data-live-search="true" name="relation_status" id="relation_status">
                <option>กรุณาเลือก</option>
                <option value="1">โสด</option>
                <option value="2">แต่งงานแล้ว</option>
                <option value="3">หม้าย</option>
                <option value="4">หย่า หรือ แยกกันอยู่</option>
              </select>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <label>เพศ</label>
              <div class="row">
                <div class="radio">
                  <label>
                    <input class="sex" type="radio" name="sex" value="1" checked>ชาย
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input class="sex" type="radio" name="sex" value="2">หญิง
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <label>ชื่อ(ภาษาไทย)</label>
              <input type="text" class="form-control" id="th_firstname" name="th_firstname" placeholder="ชื่อ"
                required>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <label>นามสกุล(ภาษาไทย)</label>
              <input type="text" class="form-control" id="th_lastname" name="th_lastname"
                placeholder="นามสกุล" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <label>ชื่อ(ภาษาอังกฤษ)</label>
              <input type="text" class="form-control" id="en_firstname" value="-" name="en_firstname"
                placeholder="First name">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <label>นามสกุล(ภาษาอังกฤษ)</label>
              <input type="text" class="form-control" id="en_lastname" value="-"  name="en_lastname"
                placeholder="Last name">
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <label>Email</label>
              <input type="email" class="form-control" id="email_address" name="email_address"
                placeholder="Email">
            </div>
          </div>
        </div>
        <div class="col-md-12 col-sm-9 col-sm-offset-3 col-md-offset-0">
          <div class="form-group">
            <div class="col-md-4 col-sm-12">
              <label>เบอร์โทรติดต่อ</label>
              <input type="text" name="tel_number" id="tel_number" class="form-control" placeholder="เบอร์โทรศัพท์"
              data-toggle="popover" data-trigger="manual" data-placement="bottom" data-content="">
            </div>
            <div class="col-md-4 col-sm-12">
              <label>สัญชาติ</label>
              <select class="form-control" value="" name="national" id="national">
                <option>กรุณาเลือก</option>
              </select>
            </div>
            <div class="col-md-4 col-sm-12">
              <label>เลขประจำตัวประชาชน/หนังสือเดินทาง</label>
              <input type="text" name="id_passport" id="id_passport" class="form-control" placeholder="ID card / Passport"
                data-toggle="popover" data-trigger="manual" data-placement="bottom" data-content="">
            </div>                     
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ibox">
    <h5>ข้อมูลผู้คำประกัน</h5>
  </div>
  <div class="ibox-content">
    <div class="form-group">
      <div class="row">
        <div class="col-md-12 col-sm-9 col-sm-offset-3 col-md-offset-0">
          <div class="form-group">
            <div class="col-md-4 col-sm-12">
              <label>ชื่อ</label>
              <input type="text" name="guarantor_firstname" id="guarantor_firstname" class="form-control" placeholder="ชื่อผู้ค้ำประกัน">
            </div>
            <div class="col-md-4 col-sm-12">
              <label>นามสกุล</label>
              <input type="text" name="guarantor_lastname" id="guarantor_lastname" class="form-control" placeholder="นามสกุลผู้ค้ำประกัน">
            </div>
            <div class="col-md-4 col-sm-12">
              <label>เกี่ยวข้องเป็น</label>                        
              <input type="text" name="guarantor_relative" id="guarantor_relative" class="form-control" placeholder="ความเกี่ยวข้อง">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ibox" style="margin-bottom:0px!important;">
    <h5>ข้อมูลผู้ติดต่อฉุกเฉิน</h5> 
    <div class="checkbox" style="padding-top:0px;">
      <label style="margin-left:15px;">
        <input type="checkbox" id="guarantor-coop-emergency"> <span class="text-info">*เหมือนกับข้อมูลของผู้คำประกัน</span>
      </label>
    </div>
  </div>
  <div class="ibox-content">
    <div class="form-group">
      <div class="row">
        <div class="col-md-12 col-sm-9 col-sm-offset-3 col-md-offset-0">
          <div class="form-group">
            <div class="col-md-4 col-sm-12">
              <label>ชื่อ</label>
              <input type="text" name="emergency_firstname" id="emergency_firstname" class="form-control" placeholder="ชื่อผู้ติดต่อฉุกเฉิน">
            </div>
            <div class="col-md-4 col-sm-12">
              <label>นามสกุล</label>
              <input type="text" name="emergency_lastname" id="emergency_lastname" class="form-control" placeholder="นามสกุลผู้ติดต่อฉุกเฉิน">
            </div>
            <div class="col-md-4 col-sm-12">
              <label>เกี่ยวข้องเป็น</label>                        
              <input type="text" name="emergency_relative" id="emergency_relative" class="form-control" placeholder="ความเกี่ยวข้อง">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>