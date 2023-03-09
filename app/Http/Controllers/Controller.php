<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Activity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Status;
use App\Contact;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function newActivity($contactID,$userID,$action,$model = null,$relatedModelID = null,$activityDate = null,$createdContact = false){
        // check if contact still new , and its not not created right now 
        
       
        $contact = Contact::findOrFail($contactID);
        
        $openStatus = Status::where('name_en','No Answer')->first();
        $newStatus = Status::where('name_en','New')->first();
        
        if(!$openStatus)
        {
            $openStatus = Status::create([
                "name_ar" => "متواصل",
                "name_en" => "No Answer",
                "active" => "1"
            ]);
        }
        
  
        //commente by fazal 
    // if(!$createdContact){ // check if he just created contact
    //     if($contact->status_id == $newStatus->id)
    //     {
    //         $state = Status::where('name_en','No Answer')->first();
            
    //         if(!$state) // create if not exsist 
    //         {
    //             $state = Status::create([
    //                 "name_ar" => "متواصل",
    //                 "name_en" => "No Answer",
    //                 "active" => "1",
    //             ]);
    //         }
            
    //         $contact = Contact::where('id',$contactID)->update([
    //             'status_id' =>  $state->id   
    //         ]);
 
    //         $scoundAction = __('site.status changed to').' '.$openStatus->name;
            
    //         $scoundData = [
    //         'contact_id' => $contactID,
    //         'user_id' => $userID,
    //         'action' => $scoundAction,
    //         'related_model' => $model,
    //         'related_model_id' => $relatedModelID,
    //       ];
      
    //         Activity::create($scoundData);
    //     }
    // }
        // 
      $activityDate = str_replace('/','-',$activityDate);
      $activityDate = $activityDate ? Carbon::createFromFormat('d-m-Y', $activityDate)->format('d-m-Y') : $activityDate;

      $data = [
        'contact_id' => $contactID,
        'user_id' => $userID,
        'action' => $action,
        'related_model' => $model,
        'related_model_id' => $relatedModelID,
      ];

      if($activityDate){
        $data['date'] = $activityDate;
      }

      Activity::create($data);
    }

    // check if table has Column
    public function checkColumn($column,$table = 'settings')
    {
        return Schema::hasColumn($table, $column);
    }
    // Create New Column
    public function newColumn($newColumnType,$newColumnName,$table = 'settings',$default = '1')
    {
      Schema::table($table, function (Blueprint $table) use ($newColumnType, $newColumnName) {
        $table->$newColumnType($newColumnName)->default($default);
      });
    }

}
