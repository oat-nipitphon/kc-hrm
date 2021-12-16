<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');;

    Auth::routes();

    Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('users', 'UserController');

    // Route::resource('permissions', 'PermissionController');
    Route::resource('roles', 'RoleController');

    Route::resource('departments', 'DepartmentController');

    //employee
    Route::get('/employees/upload-excel','EmployeeController@create_excel');
    Route::get('/employees/report','EmployeeController@leave_demo')->name('employee-report');
    Route::post('/employees/save-excel','EmployeeController@save_excel');
    Route::post('/get-employee-self','EmployeeController@get_employee_self');
    Route::resource('employees', 'EmployeeController');
    Route::resource('employee.users', 'EmployeeUserController');

    //warehouses
    Route::resource('warehouses','WarehouseController');
    Route::post('/get-warehouses','WarehouseController@get_warehouse');
    Route::post('/get-warehouses-position','WarehouseController@get_warehouse_position');
    Route::post('/warehouses-position','WarehouseController@warehouse_position');
    Route::post('/warehouse-add-position','WarehouseController@warehouse_add_position');
    Route::post('/warehouses-employees','WarehouseController@get_warehouse_employees');
    Route::post('/warehouses-employees-add','WarehouseController@get_warehouse_add_employees');
    Route::post('/warehouses-employees-save','WarehouseController@get_warehouse_save_employees');
    Route::post('/warehouses-manpower','WarehouseController@get_manpower');
    Route::post('/save-manpower','WarehouseController@save_manpower');
    Route::get('/manage-warehouse','WarehouseController@view_manage_warehouse')->name('manage.warehouse');

    //section
    Route::resource('sections','SectionController'); 
    Route::post('/sections/{id}/edit','SectionController@edit');
    Route::post('/sections/{id}','SectionController@update');
    Route::post('/get-sections','SectionController@get_sections');
        
    //divisions
    Route::resource('divisions','DivisionController'); 
    Route::post('/divisions/{id}/edit','DivisionController@edit');
    Route::post('/divisions/{id}','DivisionController@update');
    Route::post('/get-divisions','DivisionController@get_divisions');
    Route::post('/save-divisions','DivisionController@save_divisions');

    //positions
    Route::resource('positions','PositionController'); 
    Route::post('/positions/{id}/edit','PositionController@edit');
    Route::post('/positions/{id}','PositionController@update');
    Route::post('/get-positions','PositionController@get_positions');

    //warehouse -> position
    Route::get('/warehouse-position','WarehousePositionController@index')->name('warehouse-position.index');

    //carlendar
    Route::get('/calendar','CalendarController@index')->name('calendar.index');
    Route::get('/calendar-event/{id}','CalendarController@calendar_event');
    Route::post('/get-calendar','CalendarController@get_calendar');
    Route::post('/get-calendar-event','CalendarController@get_calendar_event');
    Route::post('/get-event-list','CalendarController@get_event_list');
    Route::post('/create-calendar','CalendarController@create_calendar');
    Route::post('/create-event','CalendarController@create_event');
    Route::post('/update-event','CalendarController@update_event');

    //announce
    Route::get('/announce','AnnounceController@index')->name('announce.index');
    Route::post('/get-announces','AnnounceController@get_announces');
    Route::post('/find-event-announces','AnnounceController@find_event_announces');
    Route::post('/announces-send-mail','AnnounceController@announces_send_mail');

    //user-permission
    Route::get('/set-user-permissions','UserPermissionController@index')->name('user-permisisons');
    Route::get('/manage-permission-user','UserPermissionController@permission_user_view')->name('manage permissions user');
    Route::get('/manage-permission-user/{user_id}','UserPermissionController@permission_user_view');
    Route::post('/get-user-permissions','UserPermissionController@get_user');
    Route::post('/create-employee-user','UserPermissionController@create_employee_user');
    Route::post('/get-permissions','UserPermissionController@get_permissions');
    // Route::post('/save-user-permission','UserPermissionController@save_user_permission');
    Route::get('/show-employee-user','UserPermissionController@show_employee_user')->name('user-create-page');
    Route::post('/check-employee-user','UserPermissionController@check_employee_user');
    Route::post('/save-user-permission','UserPermissionController@save_user_permission');
    Route::post('/get_edit_permission','UserPermissionController@get_edit_permission');


    Route::get('/manage-permission','PermissionController@index')->name('manage permissions');

    Route::post('/get-group-permissions','PermissionController@get_group_permissions');
    Route::post('/get-sub-group-permissions','PermissionController@get_sub_group_permissions');
    Route::post('/save-group-permission','PermissionController@save_group_permission');
    Route::post('/save-permission','PermissionController@save_permission');

    Route::get('/send-mail','CalendarController@test_mail');

    Route::get('/work-time','WorkTimeController@index')->name('worktime.index');
    Route::get('/work-time-employee','WorkTimeController@workTimeview')->name('employee.worktime');
    Route::post('/get-worktime','WorkTimeController@get_work_time');
    Route::post('/work-time-save','WorkTimeController@work_time_save');
    Route::post('/work-time-edit','WorkTimeController@work_time_edit');
    Route::post('/work-time-getemployee','WorkTimeController@getEmployees');
    Route::post('/create-workTime-employee','WorkTimeController@create_workTime_employee');
  
    Route::get('/work-time-leave','WorkTimeController@index_leave')->name('worktime.leave');
    Route::post('/get-worktime-leave','WorkTimeController@get_work_time_leave');
    Route::post('/work-time-leave-save','WorkTimeController@work_time_leave_save');
    Route::post('/work-time-leave-edit','WorkTimeController@work_time_leave_edit');

    Route::get('/work-time-ot','WorkTimeController@index_ot')->name('worktime.ot');
    Route::post('/get-worktime-ot','WorkTimeController@get_work_time_ot');
    Route::post('/work-time-ot-save','WorkTimeController@work_time_ot_save');
    Route::post('/work-time-ot-edit','WorkTimeController@work_time_ot_edit');

    Route::prefix('request-work-time')->name('request-work-time.')->group(function () {
        Route::get('/','RequestWorkTimeController@index')->name('index');
        Route::get('/pages/{pages}','RequestWorkTimeController@pages');
        Route::post('/save-request','RequestWorkTimeController@save_request');

        Route::get('/approve','RequestWorkTimeController@index_approve')->name('approve');
        Route::post('/get-approve','RequestWorkTimeController@get_request_work_time')->name('get_approve');
        Route::post('/save-approve','RequestWorkTimeController@save_request_work_time')->name('save_approve');
    });

    Route::prefix('report')->name('report.')->group(function () {
        Route::get('/report-ot','ReportController@report_ot')->name('ot');
        Route::post('/request-work-time','ReportController@report_work_time');
    });


    //timeAttendance
    Route::get('/time-Attendance',function(){
        return view('time-attendance.index');
    })->name('timeAttendance.index');

    //datatable server side
    Route::post('/get-employees','EmployeeController@getEmployees');    
    
    Route::post('/dev','TestController@dev');
    Route::post('/dev-getatt','TestController@getatt');
 
    //report hrm
    Route::prefix('kc-hrm')->name('kc-hrm.')->group(function(){
        Route::get('/hrm-report', 'HrmReportController@index')->name('report');
        Route::post('/hrm-report/search', 'HrmReportController@getReport');
    });

    
    //report Amount Good
    Route::prefix('kc-pos')->name('kc-pos.')->group(function()
    {
        Route::get('/amount-good','AmountGoodController@index')->name('report.amount-goods');
    });
    Route::get('/report/amount-goods', 'AmountGoodController@index')->name('report.amount-goods.index');
    Route::post('/report/amount-goods/ajaxrequestpost', 'AmountGoodController@ajaxrequestpost');
    Route::post('/report/amount-goods/amountGoodView', 'AmountGoodController@amountGoodView');
    Route::get('/report/amount-goods/balanceGoods', 'AmountGoodController@balanceGoods')->name('balance-goods');
    Route::post('/report/amount-goods/viewBalanceGoods', 'AmountGoodController@viewBalanceGoods');
    Route::post('/report/amount-goods/viewBalance', 'AmountGoodController@viewBalance');
    Route::post('/repost/amount-goods/figBalance', 'AmountGoodController@figBalance');

});
