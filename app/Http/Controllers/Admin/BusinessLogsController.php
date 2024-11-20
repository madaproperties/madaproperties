<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\BusinessLog;
use App\BusinessTask;
use App\BusinessDevelopment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Status;

class BusinessLogsController extends Controller
{
    public function index()
    {
      return redirect(route('admin.home'));
    }
    
    public function get_log()
    {
        $log_id = Request()->id;
        
        if(Request()->type == 'meeting')
        {
            $log = BusinessLog::where('id',$log_id)->first();
         $editView = 'admin.business-developement.components.edit-logs';
        }else{
            $log = BusinessTask::where('id',$log_id)->first();
            $editView = 'admin.business-developement.components.edit-task';
        }
        
        
        
        if(!$log) // search task 
        {
            return  false;
        }
        
      
        
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
      
     return  view($editView,[
                'task' => $log,
                'log' => $log,
                'durations' => $durations,
                'showClass' => true
            ]);
           
            
      
    }

    public function store(Request $request)
    {
     
      if($request->withtask)
      {
        $validate = [
          'duration' => 'nullable',
          "type" => "required",
          "business_id" => "required",
          "date" => "required",
          "time" => "required",
          "call_outcome" => "nullable",
          "description" => "nullable",
          "task_time" => "required",
          "task_date" => "required",
          "task_type" => "required",
          'is_log' => 'nullable',
          'status_id' => 'nullable',
          'follow_up_date' => 'nullable',
          'contact_person' =>'nullable',
           'requirement_id' => 'nullable',
          
        ];
        $msg = __('site.create new '.$request->type.' log with task');
      }else{
        $validate = [
          'duration' => 'nullable',
          "type" => "required",
          "business_id" => "required",
          "date" => "required",
          "time" => "required",
          "call_outcome" => "nullable",
          "description" => "nullable",
          'is_log' => 'nullable',
          'status_id' => 'nullable',
          'follow_up_date' => 'nullable',
          'contact_person' =>'nullable',
           'requirement_id' => 'nullable',
        ];
        $msg = __('site.create new '.$request->type.' log');
      }
      
      
      
    $contact = BusinessDevelopment::findOrFail($request->business_id);
    

    $contact->update([
        'updated_at' => Carbon::now()
  
    ]);

      $data = $request->validate($validate);
      $data['user_id'] = auth()->id();
      $data['connected_id'] = auth()->id();
      $data['business_id'] = $request->business_id;
      unset($data['task_time']);
      unset($data['task_date']);
      unset($data['task_type']);
      unset($data['status_id']);
      unset($data['status_changed_at']);
      $data['date'] = str_replace('/','-',$data['date']);
      $data['log_date'] = \Carbon\Carbon::parse(str_replace('-','/',$data['date']))->format('Y-m-d');
      $log = BusinessLog::create($data);


      $dataNoteDB = [
        'user_id' => auth()->id(),
        'business_id' => $request->business_id,
        'description' => $data['description']
      ];

      //Added by Lokesh to add follow up notification 14-08-2023 
      if($request->follow_up_date && $request->status_id == '5'){
        $contact->update([
          'follow_up_date' => \Carbon\Carbon::parse(str_replace('-','/',$request->follow_up_date))->format('Y-m-d'),
          'follow_up_day' => \Carbon\Carbon::parse(str_replace('-','/',$request->follow_up_date))->format('l')
        ]);
        $dataNoteDB['type'] = "call";
        $dataNoteDB['date'] = \Carbon\Carbon::parse(str_replace('-','/',$request->follow_up_date))->format('Y-m-d'); 
        $task = BusinessTask::create($dataNoteDB);
      }
      //End
        
      if($request->withtask)
      {
        $dataNoteDB['type'] = $request->type;
        $dataNoteDB['date'] = $request->task_date;
        $dataNoteDB['time'] = $request->task_time;
        $dataNoteDB['type'] = $request->task_type;
        $dataNoteDB['date'] = \Carbon\Carbon::parse(str_replace('-','/',$request->task_date))->format('Y-m-d'); 
        $task = BusinessTask::create($dataNoteDB);
      }


      $msg = auth()->user()->name . ' '.$msg;
      $this->newBusinessDevelopmentActivity($dataNoteDB['business_id'],$dataNoteDB['user_id'],$msg,'Log-'.$request->type,$log->id,$data['date']);
      return back()->withSuccess(__('site.success'));
    }

    public function update(Request $request,  $log)
    {

      $log = BusinessLog::findOrFail($log);
      $data = $request->validate([
        'duration' => 'nullable',
        "type" => "required",
        "business_id" => "required",
        "date" => "required",
        "time" => "required",
        "call_outcome" => "nullable",
        "description" => "nullable",
        'status_id' => 'nullable',
        'follow_up_date' => 'nullable',
        'contact_person' =>'nullable',
         'requirement_id' => 'nullable',
      ]);
      

      
    $contact = BusinessDevelopment::findOrFail($request->business_id);
    $contact->update([
      'updated_at' => Carbon::now()
    ]);

    //Added by Lokesh to add follow up notification 14-08-2023 
    if($request->follow_up_date && $request->status_id == '5'){
      $contact->update([
        'follow_up_date' => \Carbon\Carbon::parse(str_replace('-','/',$request->follow_up_date))->format('Y-m-d'),
        'follow_up_day' => \Carbon\Carbon::parse(str_replace('-','/',$request->follow_up_date))->format('l')
      ]);
    }
    //End

      unset($data['status_id']);
      unset($data['status_changed_at']);
      $data['log_date'] = \Carbon\Carbon::parse(str_replace('-','/',$data['date']))->format('Y-m-d');
      $log->update($data);
      return back()->withSuccess(__('site.success'));
    }


}
