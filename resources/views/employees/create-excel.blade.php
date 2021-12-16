@extends('layouts.app')

@section('breadcrumb')
<h2>เพิ่มพนักงาน</h2>
<ol class="breadcrumb">
  <li>
    <a href="{{route('employees.index')}}"><strong>หน้าหลัก</strong></a>
  </li>
  <li class="active">
    <strong>เพิ่มพนักงาน</strong>
  </li>
</ol>
@endsection
<style scoped>
  .radio {
    padding-left: 35px;
  }

  .popover-content {
    color: red;
    font-size: 1.1rem;
  }

  .datepicker-years .year,
  .datepicker-months .month,
  .datepicker-days .day{
    font-size: 1.2rem!important;
  }
  .datepicker-switch,
  .datepicker-days .dow,
  .datepicker .today {
    font-size: 1.3rem;
  }

</style>
@section('content')
<div class="col-12">
  <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title" style="border-top:none!important;">
          {{-- <form method="post" id="upload-excel-file" enctype="multipart/form-data" action="/employees/save-excel"> --}}
            @csrf
            <input type="file" id="excel-upload" name="select_file"/>
            <button type="button" id="upload" class="btn btn-sm btn-danger">Upload now</button>
          {{-- </form> --}}
          {{-- <button class="btn btn-sm btn-danger" id="upload">Upload now</button> --}}
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>title</th>
            <th>firstname</th>
            <th>lastname</th>
            <th>ID_card</th>
            <th>Type</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="load-table">

        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.3/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script>
  var employees_data = [];
  $('#excel-upload').change(function(e){
    let selectedFile = event.target.files[0];
    if (selectedFile) {
        var fileReader = new FileReader();
        fileReader.onload = function(event) {
          var data = event.target.result;
          var workbook = XLSX.read(data, {
            type: "binary"
          });
          var exceldata;
          workbook.SheetNames.forEach(sheet => {
            let rowObject = XLSX.utils.sheet_to_row_object_array(
              workbook.Sheets[sheet]
            );
            let jsonObject = JSON.stringify(rowObject);
            rowObject.forEach(element => {
             
                  var emp_data = {
                  'mCode' : element.mCode,
                  'emp_code' : element.emp_code,
                }             
                employees_data.push(emp_data);
             

            
            });
          });
          console.log(employees_data);
        };
        fileReader.readAsBinaryString(selectedFile);
      }
  });

$('#upload').click(function(){
  $.post("/employees/save-excel", data = {
    employees : JSON.stringify(employees_data),
    _token: '{{ csrf_token() }}',
  },
    function (res) {
      console.log(res);
    },
  );
});

// $.get("http://127.0.0.1:3002/get-employee", data = null,
//   function (res) {
//     console.log(res);
//   },
// );
var time_att = [];
 get_time_att =() =>
{
  $.getJSON(
      "http://127.0.0.1:3000/get-employee?callback=?",
      function(data){
        console.log(data.data);
      }
  );
}





</script>

<script>
        // $('#load-table').append(`
              // <tr>
              //   <th>`+ element.ID +`</th>
              //   <td>`+ title +`</td>
              //   <td>`+ firstname +`</td>
              //   <td>`+ lastname +`</td>
              //   <td>`+ element.ID_card +`</td>
              //   <td>`+ element.Type +`</td>
              //   <td>`+ element.Status +`</td>
              // </tr>
              // `);
</script>
@endsection