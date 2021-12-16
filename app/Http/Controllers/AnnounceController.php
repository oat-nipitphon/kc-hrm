<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announce;
use App\CalendarEvent;
use Mail;
class AnnounceController extends Controller
{
    public function index()
    {
        return view('announces.index');
    }

    public function get_announces()
    {
        $data['data'] = Announce::all();
        return $data;
    }

    public function find_event_announces(Request $req)
    {
        return CalendarEvent::find($req->id);
    }

    public function announces_send_mail(Request $req)
    {
        $calendar_event_id = $req->calendar_event_id;
        $emails = $req->emp_email;
        $events['events'] = json_decode(CalendarEvent::find($req->calendar_event_id)->options);
        $to_name = 'KCxxx';
        foreach ($emails as $key => $email) {
            $name = $to_name.$key;
            Mail::send('email-templates.annual-holiday-send', $events, function($message) use ($name, $email) {
                $message->to($email, $name)
                ->subject('ประกาศวันหยุดประจำปี');
                $message->from('dev.kc.demo@gmail.com','KC - metal sheet khonkaen');
            });
        }
        

        $data = [
            'title' => 'สำเร็จ',
            'msg' => 'บันทึกข้อมูลสำเร็จ',
            'status' => 'success',                
        ];
        return $data;
    }
}
