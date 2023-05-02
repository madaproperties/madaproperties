<?php
  
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Employee;
use App\Hrnotification;
use Carbon\Carbon;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
      $employee=Employee::get();
      foreach($employee as $emp)
      {
        $day= Carbon::parse($emp->date_of_birth)->format('d-m');
        $join_day=Carbon::parse($emp->date_of_join)->format('d-m');
         $today= Carbon::now()->format('d-m');
         if($day== $today)
         {
            if($emp->location=='dubai')
            {
            $res=Hrnotification::create([
              'notification' => $emp->employee_name. ' have birthday today',
              'status' => 1,
              'location'=>'dubai',
               ]);  
            }
            else
            {
             $res=Hrnotification::create([
              'notification' => $emp->employee_name. ' have birthday today',
              'status' => 1,
              'location'=>'saudi',
               ]); 
            }
            
         }
         if($join_day==$today)
         {
          if($emp->location=='dubai')
            {
               $res=Hrnotification::create([
              'notification' => $emp->employee_name.' have work anniversary today',
              'status' => 1,
              'location' =>'dubai',
               ]);
            }
            else
            {
               $res=Hrnotification::create([
              'notification' => $emp->employee_name.' have work anniversary today',
              'status' => 1,
              'location' =>'saudi',
               ]);
            }

         
         }

        // probation
          $join_date=$emp->date_of_join;
          $AfterSixMonthDate = \Carbon\Carbon::parse($join_date)->addMonths(6);
          $final=Carbon::parse($AfterSixMonthDate)->format('Y-m-d');
          $today= Carbon::now()->format('Y-m-d');
          if($final==$today)
          {
            if($emp->location=='dubai')
            {
            $res=Hrnotification::create([
              'notification' => $emp->employee_name. ' probation end by today',
              'status' => 1,
              'location'=>'dubai',
               ]);   
            } 
            else
            {
            $res=Hrnotification::create([
              'notification' => $emp->employee_name. ' probation end by today',
              'status' => 1,
              'location'=>'dubai',
               ]);  
            }
             
          } 


      }
        
    }
}
