<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Log;
use App\Contact;
use App\Task;
use App\User;
use App\Status;

class CalendarController extends Controller
{
    public function index()
    {

      if(userRole() == 'leader')
      {
          $usersIds = User::select('id','rule','leader')
                        ->where('leader',auth()->id())->get();
                        
          $usersIds = $usersIds->pluck('id');
          $usersIds->push(auth()->id());

          $meetings = Log::where('type','meeting')->whereIn('user_id',$usersIds->toArray())->get();
          $tasks = Task::whereIn('user_id',$usersIds->toArray())->get();
          $logs = Log::whereIn('user_id',$usersIds->toArray())->get();
          
      }else {
        $meetings = Log::where('type','meeting')->where('user_id',auth()->id())->get();
        $tasks = Task::where('user_id',auth()->id())->get();
        $logs = Log::where('user_id',auth()->id())->get();
      }

      $rows = [];
      $today = \Carbon\Carbon::today();
      $today = $today->format('y/m/d');
      $meetingTodayIds = [];

      foreach($meetings as $meeting)
      {
        $start_date = str_replace('-','/',$meeting['date']) . ' '.$meeting['time'];
        $start_date = \Carbon\Carbon::parse($start_date);

        if($today == $start_date->format('y/m/d'))
        {
          $meetingTodayIds[] = $meeting->id;
        }


        $rows[] = [
          'id' => $meeting['id'],
          'date' => $start_date,
          'time' => $meeting['time'],
          'description' => $meeting['duration'],
          'type' => 'meeting'
        ];

      }

      $tasksDayIds = [];
      foreach($tasks as $task)
      {
        $task_start_date = str_replace('-','/',$task['date']);
        $task_start_date  = \Carbon\Carbon::parse($task_start_date.' '.$task['time'])->format('Y-m-d H:i');

        $compare = \Carbon\Carbon::parse($task['date']);
        
        if($today == $compare->format('y/m/d'))
        {
          $tasksDayIds[] = $task->id;
        }

        $rows[] = [
          'id' => $task['id'],
          'date' => $task_start_date,
          'time' => $task['time'],
          'description' => $task['description'],
          'type' => 'task'
        ];
      }
      // today data
      // $logs = Log::whereIn('id',$meetingTodayIds)->get();
      // $tasks = Task::whereIn('id',$tasksDayIds)->get();

      // hundel duration
      $minutes = [
        '15',
        '30',
        '45',
      ];
      
      $durations = [];
      
      for($i =0;$i<=8;$i++)
      {
        foreach($minutes as $minute)
        {
          $time = $i . ' horse '.$minute .' minutes';
          $durations[] = str_replace('0 horse ','',$time);
        }
      }
      
      $status = Status::where('active','1')->get();
   


      return view('admin.calendar.index',[
        'meetings' => $meetings,
        'tasks' => $tasks,
        'logs' => $logs,
        'durations' => $durations,
        'rows' => $rows,
        'status' => $status
      ]);

    }
}
