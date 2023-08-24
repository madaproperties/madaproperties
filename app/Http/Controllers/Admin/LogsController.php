<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Log;
use App\Task;
use App\Contact;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Status;

class LogsController extends Controller
{
    
    
    public function get_log()
    {
        $log_id = Request()->id;
        
        if(Request()->type == 'meeting')
        {
            $log = Log::where('id',$log_id)->first();
         $editView = 'admin.contacts.components.edit-logs';
        }else{
            $log = Task::where('id',$log_id)->first();
            $editView = 'admin.contacts.components.edit-task';
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
          "contact_id" => "required",
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
          
        ];
        $msg = __('site.create new '.$request->type.' log with task');
      }else{
        $validate = [
          'duration' => 'nullable',
          "type" => "required",
          "contact_id" => "required",
          "date" => "required",
          "time" => "required",
          "call_outcome" => "nullable",
          "description" => "nullable",
          'is_log' => 'nullable',
          'status_id' => 'nullable',
          'follow_up_date' => 'nullable',
        ];
        $msg = __('site.create new '.$request->type.' log');
      }
      
      
      
     $contact = Contact::findOrFail($request->contact_id);
    

    // check status
    if($request->status_id){
      if($request->status_id != $contact->status_id)
      {
        $data['status_changed_at'] = Carbon::now();
        $action = __('site.status changed to').' '.Status::where('id',$request->status_id)->first()->name;
        $this->newActivity($contact->id,auth()->id(),$action,null,null, null,true);
        $contact->update([
            'status_changed_at' => $data['status_changed_at'],
            'status_id' =>   $request->status_id,
            'lead_type' => $request->lead_type,
            'follow_up_date' => null
        ]);
      }
    }
     
     
    $contact->update([
        'lead_type' => $request->lead_type,
        'updated_at' => Carbon::now()
  
    ]);

      $data = $request->validate($validate);
      $data['user_id'] = auth()->id();
      $data['connected_id'] = auth()->id();
      $data['contact_id'] = $request->contact_id;
      unset($data['task_time']);
      unset($data['task_date']);
      unset($data['task_type']);
      unset($data['status_id']);
      unset($data['status_changed_at']);
      $data['date'] = str_replace('/','-',$data['date']);
      $data['log_date'] = \Carbon\Carbon::parse(str_replace('-','/',$data['date']))->format('Y-m-d');
      $log = Log::create($data);


      $dataNoteDB = [
        'user_id' => auth()->id(),
        'contact_id' => $request->contact_id,
        'description' => $data['description']
      ];

      //Added by Lokesh to add follow up notification 14-08-2023 
      if($request->follow_up_date && $request->status_id == '5'){
        $contact->update([
          'follow_up_date' => \Carbon\Carbon::parse(str_replace('-','/',$request->follow_up_date))->format('Y-m-d')
        ]);
        $dataNoteDB['type'] = "call";
        $dataNoteDB['date'] = \Carbon\Carbon::parse(str_replace('-','/',$request->follow_up_date))->format('Y-m-d'); 
        $task = Task::create($dataNoteDB);
      }
      //End
        
      if($request->withtask)
      {
        $dataNoteDB['type'] = $request->type;
        $dataNoteDB['date'] = $request->task_date;
        $dataNoteDB['time'] = $request->task_time;
        $dataNoteDB['type'] = $request->task_type;
        $dataNoteDB['date'] = \Carbon\Carbon::parse(str_replace('-','/',$request->task_date))->format('Y-m-d'); 
        $task = Task::create($dataNoteDB);
      }


      $msg = auth()->user()->name . ' '.$msg;
      $this->newActivity($dataNoteDB['contact_id'],$dataNoteDB['user_id'],$msg,'Log-'.$request->type,$log->id,$data['date']);
      return back()->withSuccess(__('site.success'));
    }

    public function update(Request $request,  $log)
    {

      $log = Log::findOrFail($log);
      $data = $request->validate([
        'duration' => 'nullable',
        "type" => "required",
        "contact_id" => "required",
        "date" => "required",
        "time" => "required",
        "call_outcome" => "nullable",
        "description" => "nullable",
        'status_id' => 'nullable',
        'follow_up_date' => 'nullable',
      ]);
      

      
     $contact = Contact::findOrFail($request->contact_id);
     if($request->status_id){
      // check status
      if($request->status_id != $contact->status_id)
      {
        $data['status_changed_at'] = Carbon::now();
        $action = __('site.status changed to').' '.Status::where('id',$request->status_id)->first()->name;
        $this->newActivity($contact->id,auth()->id(),$action,null,null, null,true);
        $contact->update([
            'status_changed_at' => $data['status_changed_at'],
            'status_id' =>   $request->status_id,
            'follow_up_date' => null
        ]);
      }
     }
      $contact->update([
        'lead_type' => $request->lead_type,
        'updated_at' => Carbon::now()
      ]);

      //Added by Lokesh to add follow up notification 14-08-2023 
      if($request->follow_up_date && $request->status_id == '5'){
        $contact->update([
          'follow_up_date' => \Carbon\Carbon::parse(str_replace('-','/',$request->follow_up_date))->format('Y-m-d')
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
