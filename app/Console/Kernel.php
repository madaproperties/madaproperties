<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Carbon\Carbon;
use App\Task;
use App\Notofication;
use App\Contact;
use App\LeadPoolActivity;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $tasks = DB::table('tasks')->get();
        $collectfutcherTasks = [];
        
        foreach($tasks as $task)
        {
            $task->newDate =Carbon::parse( $task->date);
            
            if($task->newDate == Carbon::now()->toDateTimeString())
            {
                $collectfutcherTasks[] = $task;
            }
        }
        
         foreach($collectfutcherTasks as $task)
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

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
