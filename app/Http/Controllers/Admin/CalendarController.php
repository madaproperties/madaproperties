<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CommercialLog;
use App\Contact;
use App\Task;
use App\CommercialTask;
use App\User;
use App\Status;
use  App\Log;
class CalendarController extends Controller
{

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     function __construct()
     {
          $this->middleware('permission:calendar-list', ['only' => ['index']]);
    }  
    public function index(Request $request)
    {
      
      if(!empty($request->start)){
        $start_date = date('Y-m-d',strtotime($request->start));
        $end_date = date('Y-m-d',strtotime($request->end));
      }

      if(userRole() == 'leader' || userRole() == 'admin' || userRole() == 'sales admin uae' || userRole() == 'sales admin saudi')
      {
          if(userRole() == 'admin'){
            if(!empty($request->start)){
              $meetings = Log::where('type','meeting')
                        ->whereBetween('log_date',[$start_date,$end_date])->get();
              $tasks = Task::whereBetween('date',[$start_date,$end_date])->get();
            }else{
              $meetings = Log::where('type','meeting')->get();
              //$tasks = Task::whereIn('user_id',$usersIds->toArray())->get();
              $tasks = [];
            }
            //$logs = Log::whereIn('user_id',$usersIds->toArray())->get();
            $logs = [];

          }else if(userRole() == 'sales admin uae'){
            $whereCountry = 'Asia/Dubai';
            $usersIds = User::select('id','rule','leader')
                          ->where('time_zone','like','%'.$whereCountry.'%')->get();
                          
            $usersIds = $usersIds->pluck('id');
            $usersIds->push(auth()->id());
            if(!empty($request->start)){
              $meetings = Log::where('type','meeting')->whereIn('user_id',$usersIds->toArray())
                        ->whereBetween('log_date',[$start_date,$end_date])->get();
              $tasks = Task::whereIn('user_id',$usersIds->toArray())->whereBetween('date',[$start_date,$end_date])->get();
            }else{
              $meetings = Log::where('type','meeting')->whereIn('user_id',$usersIds->toArray())->get();
              //$tasks = Task::whereIn('user_id',$usersIds->toArray())->get();
              $tasks = [];
            }
            //$logs = Log::whereIn('user_id',$usersIds->toArray())->get();
            $logs = [];

          }else if(userRole() == 'sales admin saudi'){
            $whereCountry = 'Asia/Riyadh';
            $usersIds = User::select('id','rule','leader')
                          ->where('time_zone','like','%'.$whereCountry.'%')->get();
                          
            $usersIds = $usersIds->pluck('id');
            $usersIds->push(auth()->id());
            if(!empty($request->start)){
              $meetings = Log::where('type','meeting')->whereIn('user_id',$usersIds->toArray())
                        ->whereBetween('log_date',[$start_date,$end_date])->get();
              $tasks = Task::whereIn('user_id',$usersIds->toArray())->whereBetween('date',[$start_date,$end_date])->get();
            }else{
              $meetings = Log::where('type','meeting')->whereIn('user_id',$usersIds->toArray())->get();
              //$tasks = Task::whereIn('user_id',$usersIds->toArray())->get();
              $tasks = [];
            }
            //$logs = Log::whereIn('user_id',$usersIds->toArray())->get();
            $logs = [];

          }else{
            $usersIds = User::select('id','rule','leader')
                          ->where('leader',auth()->id())->get();
                          
            $usersIds = $usersIds->pluck('id');
            $usersIds->push(auth()->id());
            if(!empty($request->start)){
              $meetings = Log::where('type','meeting')->whereIn('user_id',$usersIds->toArray())
                        ->whereBetween('log_date',[$start_date,$end_date])->get();
              $tasks = Task::whereIn('user_id',$usersIds->toArray())->whereBetween('date',[$start_date,$end_date])->get();
            }else{
              $meetings = Log::where('type','meeting')->whereIn('user_id',$usersIds->toArray())->get();
              //$tasks = Task::whereIn('user_id',$usersIds->toArray())->get();
              $tasks = [];
            }
            //$logs = Log::whereIn('user_id',$usersIds->toArray())->get();
            $logs = [];
          }
      }else {
        if(userRole() == 'commercial leader' || userRole() == 'commercial sales'){
          if(userRole() == 'commercial leader'){
            $usersIds = User::select('id','rule','leader')
            ->where('leader',auth()->id())->get();
            
            $usersIds = $usersIds->pluck('id');
            $usersIds->push(auth()->id());
            if(!empty($request->start)){
            $meetings = CommercialLog::where('type','meeting')->whereIn('user_id',$usersIds->toArray())
                      ->whereBetween('log_date',[$start_date,$end_date])->get();
            $tasks = CommercialTask::whereIn('user_id',$usersIds->toArray())->whereBetween('date',[$start_date,$end_date])->get();
            }else{
            $meetings = CommercialLog::where('type','meeting')->whereIn('user_id',$usersIds->toArray())->get();
            //$tasks = Task::whereIn('user_id',$usersIds->toArray())->get();
            $tasks = [];
            }
            //$logs = Log::whereIn('user_id',$usersIds->toArray())->get();
            $logs = [];

          }else{
            if(!empty($request->start)){
              $meetings = CommercialLog::where('type','meeting')->where('user_id',auth()->id())
                ->whereBetween('log_date',[$start_date,$end_date])->get();
                $tasks = CommercialTask::where('user_id',auth()->id())->whereBetween('date',[$start_date,$end_date])->get();
              }else{
              $meetings = CommercialLog::where('type','meeting')->where('user_id',auth()->id())->get();
              $tasks = CommercialTask::where('user_id',auth()->id())->get();
            }
            $logs = CommercialLog::where('user_id',auth()->id())->get();
          }
        }else{
        if(!empty($request->start)){
          $meetings = Log::where('type','meeting')->where('user_id',auth()->id())
            ->whereBetween('log_date',[$start_date,$end_date])->get();
            $tasks = Task::where('user_id',auth()->id())->whereBetween('date',[$start_date,$end_date])->get();
          }else{
          $meetings = Log::where('type','meeting')->where('user_id',auth()->id())->get();
          $tasks = Task::where('user_id',auth()->id())->get();
        }
        $logs = Log::where('user_id',auth()->id())->get();
        }
      }
      

      $rows = [];
      $today = \Carbon\Carbon::today();
      $today = $today->format('y/m/d');
      $meetingTodayIds = [];

      foreach($meetings as $meeting)
      {
        $start_date = str_replace('-','/',$meeting['log_date']) . ' '.date('h:i A',strtotime($meeting['time']));
        if(strlen($start_date) < 20){
          $start_date = \Carbon\Carbon::parse($start_date)->format('Y-m-d H:i');

        //   if($today == $start_date->format('y/m/d'))
        //   {
        //     $meetingTodayIds[] = $meeting->id;
        //   }


          $rows[] = [
            'id' => $meeting['id'],
            'date' => $start_date,
            'time' => $meeting['time'],
            'description' => $meeting['duration'],
            'type' => 'meeting',
            'title' => 'meeting'
          ];
        }

      }

      $tasksDayIds = [];
      foreach($tasks as $task)
      {
        $task_start_date = str_replace('-','/',$task['date']);
        if(strlen($task_start_date.' '.$task['time']) < 20){
          $task_start_date  = \Carbon\Carbon::parse($task_start_date.' '.$task['time'])->format('Y-m-d H:i');

          // $compare = \Carbon\Carbon::parse($task['date']);
          
          // if($today == $compare->format('y/m/d'))
          // {
          //   $tasksDayIds[] = $task->id;
          // }

          $rows[] = [
            'id' => $task['id'],
            'date' => $task_start_date,
            'time' => $task['time'],
            'description' => $task['description'],
            'type' => 'task',
            'title' => 'task-'.$task['type']
          ];
        }
      }
      if(!empty($request->start)){
        return $rows;
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

    public function updateOldDate(){
      $logs = Log::where('date_update',0)->get();      
      foreach ($logs as $log) {
        Log::where('id',$log->id)->update(['date_update'=>1,'log_date'=>\Carbon\Carbon::parse(str_replace('-','/',$log->date))->format('Y-m-d')]);
      }
    }
}
