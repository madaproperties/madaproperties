<?php
  
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Employee;
use App\Notofication;
use Carbon\Carbon;
use App\LeadPoolActivity;
use DB;

class AddNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notification add';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      $tasks = DB::table('tasks')->whereDate('date',Carbon::now())->get();
      $collectfutcherTasks = [];
      
      // foreach($tasks as $task)
      // {
      //     $task->newDate =Carbon::parse( $task->date);
          
      //     if($task->newDate == Carbon::now()->toDateTimeString())
      //     {
      //         $collectfutcherTasks[] = $task;
      //     }
      // }
      
        foreach($tasks as $task)
      {
          
          $note = "#Task reminder ".$task->date . ' - '.$task->time ;
          
          $contactUrl = route('admin.contact.show',$task->contact_id);
        
          
          $description =$note."<a href='".$contactUrl."'>View</a><br>"  ;
            
          Notofication::create([
              'description' => $note,
              'created_by' => $task->user_id,
              'user_id' => $task->user_id
          ]);
      }
      
  }
}
