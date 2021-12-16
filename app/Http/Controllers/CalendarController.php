<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calendar;
use App\CalendarEvent;
use Carbon\Carbon;
use Mail;


class CalendarController extends Controller
{
    public function index()
    {
        return view('calendars.index');
    }

    public function calendar_event($calendar_id)
    {
        $events = CalendarEvent::where('calendar_id',$calendar_id)->orderBy('id','asc')->get();
        return view('calendars.events',compact('calendar_id','events'));
    }

    public function get_calendar()
    {
        $data['data'] = Calendar::get();
        return $data;
    }

    public function get_calendar_event(Request $req)
    {
        if($req->event_id == null){
            $events = CalendarEvent::where('calendar_id',$req->calendar_id)->first();
        }else{
            $events = CalendarEvent::where('calendar_id',$req->calendar_id)
                                    ->where('id',$req->event_id)                    
                                    ->first();   
        }
        
        return $events;
    }

    public function get_event_list(Request $req)
    {
        $event_list = CalendarEvent::where('calendar_id',$req->calendar_id)->get();
        return $event_list;
    }

    public function create_calendar(Request $req)
    {
        $calendar = new Calendar;
        $calendar->name = $req->name;
        if($calendar->save()){
            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกข้อมูลสำเร็จ',
                'status' => 'success',                
            ];
        }else{
            $data = [
                'title' => 'เกิดข้อผิดพลาด',
                'msg' => 'บันทึกข้อมูลล้มเหลว',
                'status' => 'error',                
            ];
        }
        return $data;
    }

    public function create_event(Request $req)
    {
        $empty_json = [];
        $event = new CalendarEvent;
        $event->name = $req->name;
        $event->options = json_encode($empty_json);
        $event->calendar_id = $req->calendar_id;
        
        if($event->save()){
            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกข้อมูลสำเร็จ',
                'status' => 'success',                
            ];
        }else{
            $data = [
                'title' => 'เกิดข้อผิดพลาด',
                'msg' => 'บันทึกข้อมูลล้มเหลว',
                'status' => 'error',                
            ];
        }
        return $data;
    }

    public function update_event(Request $req)
    {
        $event = CalendarEvent::find($req->id);
        $event->options = json_encode($req->options);

        if($event->save()){
            $data = [
                'title' => 'สำเร็จ',
                'msg' => 'บันทึกข้อมูลสำเร็จ',
                'status' => 'success',                
            ];
        }else{
            $data = [
                'title' => 'เกิดข้อผิดพลาด',
                'msg' => 'บันทึกข้อมูลล้มเหลว',
                'status' => 'error',                
            ];
        }
        return $data;
    }



    public function test_mail()
    {
        $to_name = 'RECEIVER_NAME';
        $to_email = 'rxpoison.ct@gmail.com';
        $data = array('name'=>'chammy', 'body' => 'test send mail');

        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
            ->subject('Laravel Test Mail');
            $message->from('dev.kc.demo@gmail.com','Test Mail');
        });
    }

   
}
