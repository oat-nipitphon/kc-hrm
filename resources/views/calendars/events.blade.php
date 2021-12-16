@extends('layouts.app')

@section('breadcrumb')
<h2>หน้าหลัก</h2>
<ol class="breadcrumb">
  {{--<li>--}}
    {{--<a href="{{index.html}}">หน้าหลัก</a>--}}
  {{--</li>--}}
  <li class="active">
    <strong>หน้าหลัก</strong>
  </li>
</ol>
@endsection
<link href='/lib/fullcalendar/core/main.css' rel='stylesheet'/>
<link href='/lib/fullcalendar/daygrid/main.css' rel='stylesheet'/>
<link href='/lib/fullcalendar/timegrid/main.css' rel='stylesheet'/>
@section('content')

<div class="row wrapper border-bottom white-bg page-heading" style="padding-top:15px;">
    <a class="btn btn-success btn-sm" href="{{route('calendar.index')}}">กลับหน้าหลัก</a>
    <div class="card-header">
        <h5 class="card-title">
            <h3>ปฏิทิน</h3>
        </h5>
    </div>
    <div class="card-body ibox-content">
      <div class="row">
        <div class="col-md-4">
          <div class="row">
            <div class="col-12">
              <h2>Calendar list</h2>
            </div>
            <div class="row" style="padding-top: 8.5px;">
              <div class="col-md-8">              
                  <select class="form-control" id="event-list">
                  </select>
              </div>
              <div class="col-md-4" style="padding-left:0px;">
                <button class="btn btn-success" id="add-event"><span class="fa fa-plus"></span> เพิ่มกิจกรรม</button>
              </div>
            </div>            
          </div>         
        </div>
        <div class="col-md-8">
          <div id="calendar"></div>
        </div>
        
      
      </div>     
    </div>
    <div class="card-header">
      <h5 class="card-title">
        <h3>รายการกิจกรรมต่างๆ</h3>
      </h5>
    </div>
    <div class="card-body ibox-content">
      <div class="row" id="event-list-bottom">
      </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-event-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ข้อมูลกิจกรรม</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>ชื่อกิจกรรม</label>
            <input type="text" class="form-control" id="event-name" placeholder="ex วันหยุดประจำปี ,กิจกรรมเข้าอบรมประจำปี, etc">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="button" id="save-event" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="new-event-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">ข้อมูลกิจกรรม</h4>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label>ชื่อกิจกรรมประจำวัน</label>
            <input type="text" class="form-control" id="event-title" placeholder="ex อบรมประจำปี">
          </div>
          <div class="form-group">
            <label>วันที่ (ปี/เดือน/วัน)</label>
            <input type="text" class="form-control" id="event-start">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="button" id="save-new-event" class="btn btn-primary">บันทึก</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script src='/lib/fullcalendar/core/main.js'></script>
<script src='/lib/fullcalendar/daygrid/main.js'></script>
<script src='/lib/fullcalendar/interaction/main.js'></script>
<script src='/lib/fullcalendar/timegrid/main.js'></script>
<script>
var calendar_id = '{{$calendar_id}}';

var events = [];
$('#add-event').click(function(){
  $('#add-event-modal').modal('show');
});


$('#event-list').change(function(){
  let event_id = $(this).val();
  call_calendar(calendar_id,event_id);
});

$('#save-new-event').click(function () {
  if ($('#event-title').val()) {
    let event_data = {
      title : $('#event-title').val(),
      start : $('#event-start').val(),
      backgroundColor : '#F73636',
      borderColor : '#F73636',
    }
    events.push(event_data); 
    $.post("/update-event", data = {
      _token: '{{ csrf_token() }}',
      options : events,
      id : $('#event-list').val()
    },
      function (res) {
        swal.fire(res.title, res.msg, res.status).then(function () {
          call_calendar(calendar_id,null);
          (res.status == 'success') ? $('#new-event-modal').modal('hide'): true;
        });
      },
    );
  }
});


$('#save-event').click(function(){
  let event_name = $('#event-name');
  if(event_name){
    $.post("/create-event", data = {
      calendar_id: calendar_id,
      name: event_name.val(),
      _token: '{{ csrf_token() }}',
    },
      function (res) {
        swal.fire(res.title, res.msg, res.status).then(function () {
          event_list();
          (res.status == 'success') ? $('#add-event-modal').modal('hide'): true;
        });
      },
    );
  }
});

function call_calendar(calendar_id,event_id) {
  $.post("/get-calendar-event", data = {
      _token: '{{ csrf_token() }}',
      calendar_id: calendar_id,
      event_id:event_id,
    },
    function (res) {
      if(res){
        var event = JSON.parse(res.options);
        event_list_detail(event);
      }else{
        var event = [];        
      }
      events = event;
      $('#calendar').empty();
      var calendarEvent = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEvent, {
        plugins: ['interaction','dayGrid','timeGrid'],
        selectable: true,
        events: event,
        // eventClick: function (info) {
        //   alert('Event: ' + info.event.title);
        // },
        dateClick: function (info) {
          // info.dateStr
            add_event_detail(info.dateStr);
        },
      });
      calendar.render();
    
    },
  );
}

function add_event_detail(get_date){
  $('#event-start').val(get_date);
  $('#new-event-modal').modal('show');
 
  // console.log(events);
}

function event_list_detail(event) {
  let event_list = $('#event-list-bottom');
  event_list.empty();

  event.forEach(element => {
    event_list.append($('<a></a>')
      .attr('href', 'javascript:void()')
      .attr('style', 'padding-left:5px;padding-right:5px;')
      .addClass('col')
      .append($('<small></small>')
        .addClass('badge badge-success')
        .text(element.start + ' ' + element.title)));
  });   
}

function event_list() {
  $.post("/get-event-list", data = {
      _token: '{{ csrf_token() }}',
      calendar_id: calendar_id
    },
    function (res) { 
      let event_list = $('#event-list');
 
      event_list.empty();
      if(res != ''){
          res.forEach(element => {          
          event_list.append($('<option></option>').attr('value', element.id).text(element.name));
          event_list.selectpicker('refresh');
        });
      }else{         
          event_list.append($('<option></option>').attr('value', 'ยังไม่มีข้อมูลอีเว้น').text('ยังไม่มีข้อมูลอีเว้น'));
          event_list.selectpicker('refresh');
      }    
    },
  );
}



event_date = [
            {
                "title": "วันสงกรานต์",
                "start": "2020-04-13",
                "backgroundColor" : "",            
                'borderColor' : '#F73636'       
            },
            {
                "title": "วันสงกรานต์",
                "start": "2020-04-14",
                "backgroundColor" : "",            
                'borderColor' : '#F73636'       
            },
            {
                "title": "วันสงกรานต์",
                "start": "2020-04-15",
                "backgroundColor" : "",            
                'borderColor' : '#F73636'       
            },
    ];

$(document).ready(function () {
  call_calendar(calendar_id,null);
  event_list();
});

</script>
@endsection
