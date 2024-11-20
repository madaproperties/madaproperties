<?php

namespace App\Imports;

use App\Contact;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Country;
use App\City;
use App\User;
use App\Project;
use App\LastMileConversion;
use App\Status;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Carbon\Carbon;


class ContactsImport implements ToCollection, WithHeadingRow,ShouldQueue,WithChunkReading 
{

    private $errors = [];
    private $validateAttribute = [
              "first_name.*" => "required|max:255",
              "last_name.*" => "nullable|max:255",
              "email.*" => "nullable|email|max:255",
              "phone.*" => "required|max:20",
              "country.*" => "required|max:255",
              "city.*" => "nullable|max:20",
              "scound_phone.*" => "nullable|max:20",
              "budget.*" => "nullable|max:200",
              "currency.*" => "nullable|max:20",
              "project_id.*" => "nullable|max:20",
              "last_mile_conversion.*" => "required|max:20",
              "lead_type.*" => "required|max:255",
              "campaign.*" => "nullable|max:255",
              "source.*" => "nullable|max:255",
              "medium.*" => "nullable|max:255",
              "lang.*" => "nullable|max:255",
              "purpose.*" => "required|max:255",
              "purpose_type.*" => "nullable|max:255",
              "content.*" => "nullable|max:255",
              "unit_country.*" => "nullable|max:20",
              "unit_city.*" => "nullable|max:20",
              "unit_zone.*" => "nullable|max:255",
              "assignedto_id.*" => "nullable|max:20|exists:users,id",
            ];

    public function collection(Collection $rows)
    {
        $contactsData = $rows->slice(0);
        $rowsArray = $contactsData->toArray();
        
        $reqiuredFeilds = [];
        
        // get required feilds to validate them 
        foreach($this->validateAttribute as $key => $val)
        {
            $key = str_replace('.*','',$key);
            $find = str_contains($val,'required');
            if($find)
            {
                $key = str_replace('.*','',$key);
                $reqiuredFeilds[] = $key;
            }
        }
        
  
        foreach($rowsArray as $index => $rows)
        {
            $index++;
            $rows = array_keys($rows);
            
            foreach($reqiuredFeilds as $feild)
            {
                if(! in_array($feild,$rows))
                {
                     $this->addErorr("#[".$index."] field ". $feild . ' required');
                }
            }
        }
        
        
        
        Validator::make($rowsArray, $this->validateAttribute)->validate();
            
       
    // check [country_id,city_id,project_id,last_mile_conversion,unit_country,unit_city,admin is leader for assigned to,allowed to add purpose]
    // get country id
      $errors = [];
      
      foreach($this->validateAttribute as  $val => $key)
      {
          $trimRules[] = str_replace('.*','',$val);
      }
     
        // check if he passed attribute that deast exsist in rules 
      foreach($rowsArray[0] as $rowAr => $v)
      {
          if(! in_array($rowAr,$trimRules)){
               $this->addErorr("UNKNOWN Feild ". $rowAr);
          }
      }
      
      // check if there is errors 
      
      if($this->errors)
      {
          return redirect(route('admin.'))->withErrors($this->errors);
      }
      
     // end check if he pass invalide feilds names 
       
      foreach($contactsData as $index => $contact)
      {   // Get ID's
          $index++;
          
            
            // check if lead exsist before in the same team 
            if(userRole() == 'leader')
            {
                $leader = auth()->id();    
            }
        
             $leader = userRole() == 'leader' ? auth()->id() :  auth()->user()->leader;
             

            $countryCode = Country::where('id',$contact['country'])->first();
            $countryCode = $countryCode ? $countryCode->id : null;
            
            if($leader)
            {
                $leaderUsers = User::whereIn('leader',$leader)
                ->OrWhere('id', $leader)->get()->pluck('id')->toArray();
              
                
             if(userRole() == 'sales admin' || userRole() == 'assistant sales director')
             {
              
                $checkcontact = Contact::where('phone',$contact['phone']) 
                                        ->where('country_id',$countryCode)
                                        ->whereIn('created_by',$leaderUsers)
                                        ->first();
                // if ! countiue search 
                if(!$checkcontact)
                {
                     $checkcontact = Contact::where('phone',$contact['phone']) 
                                            ->where('country_id',$countryCode)
                                            ->whereIn('user_id',$leaderUsers)
                                            ->first();
                }
                                  
             }else{
                $checkcontact = Contact::where('phone',$contact['phone']) 
                                      ->where('country_id',$countryCode)
                                    ->whereIn('user_id',$leaderUsers)
                                    ->first();
             }
                if($checkcontact)
                {
                    if(newStatus()->id != $contact['status_id']){
                            $updaetDate['status_id'] = newStatus()->id;
                            $updaetDate['status_changed_at'] = Carbon::now();
                             $action = __('site.status changed to').' '.newStatus()->name;
                    
                        newActivity($checkcontact->id,auth()->id(),$action,null,null, null,true);
                    }
            
                    // create activity 
                    $action = __('site.tried to enter contact agian');
                    newActivity($checkcontact->id,auth()->id(),$action);
                    // back with messge 
                 
                    $checkcontact->update($updaetDate);
                    
                    $this->addErorr(__('site.leader exists before') . ' #'.$checkcontact->phone);
                }
                
            }
            
        
            // end check if lead exsist before 
         
          $country_id = $this->getID($index,'Country','name_en',$contact['country']);
          $contact['country_id'] = $country_id;
          
          $city_id = $this->getID($index,'City','name_en',$contact['city'],$country_id);
          $contact['city_id'] = $city_id;
          
          $project_id =  $this->getID($index,'Project','name_en',$contact['project_id']);
          $contact['project_id'] = $project_id;
          $last_mile_conversion = $this->getID($index,'last_mile_conversion','name_en',$contact['last_mile_conversion']);
          $contact['last_mile_conversion'] = $last_mile_conversion;
          $unit_country = $this->getID($index,'unit_country','name_en',$contact['unit_country']);
          $contact['unit_country'] = $unit_country;
          $unit_city = $this->getID($index,'unit_city','name_en',$contact['unit_city'],$contact['unit_country']);
          $contact['unit_city'] = $unit_city;
        
          // if there is assigned to will be the smae value - atherwise will be the uploder
          $contact['user_id'] = !empty($contact['assignedto_id']) ? $contact['assignedto_id'] : auth()->id();
          // check if he assigned to anther one i have to check if the currentauth is the leader , or the cuurun one is not a admin 
          if($contact['user_id'] != auth()->id() AND userRole() != 'admin') 
          {
            $checkAssigned = User::where('id',$contact['user_id'])
                                ->whereIn('leader',auth()->id())->first();
            
                
                    if(!$checkAssigned AND $auth_user->rule == 'leader')
                    {
                         $this->addErorr(__('site.you are not leader for user numer').' ['. $contact['user_id'].']');
                    }
                
            
          }
          
          
          if(userRole() == 'sales admin' || userRole() == 'assistant sales director')
        {   
            $user = User::where('id',$contact['user_id'])->first();
            $auth_user= auth()->id(); 
            // if($user->leader  != $auth_user->leader AND $user->id != $auth_user->leader)
            // {
            //  $this->addErorr(__('site.you are not leader for user numer').' ['. $contact['user_id'].']');
            // }
        }
         
          $contact['created_by'] = auth()->id(); // assigned created by for the currunt auth
    
           unset($contact['assignedto_id']); // remove asssigned to => replaced with user_id
           unset($contact['city']);
           unset($contact['country']);
        
          // check if he has postion  
          $contact_purpose = $contact['purpose'];
          $user_position_types = json_decode(auth()->user()->position_types);
            
           
        $contact_purpose =  strtolower($contact_purpose);

          if(! in_array($contact_purpose, $user_position_types) OR  !$contact_purpose)
          {
            $this->addErorr(__('site.you are not allowed to create that purpose '). $contact['purpose'] . ' #['. $index . ']');
          }

      }
    

      if(!$this->errors)
      {
        foreach($contactsData as $contact) {
          $contact = $contact->toArray();
          // get new status 
          $status = Status::where('name_en','new')->first();
          if(empty($status))
          {
            $status = Status::create([
              'name_ar' => 'جديد',
              'name_en' => 'new',
              'active' => '1'
            ]);
          }
          $contact['status_id'] = $status->id;
          $contact['created_from'] = 'import file';
         
          $contact = Contact::create($contact);

          $action = __('site.contact created');
          newActivity($contact->id,auth()->id(),$action,'Contact',$contact->id);

        }
        session()->flash('success',__('site.success'));
      }else{
  
        return redirect(route('admin.'))->withErrors($this->errors);
      }
    }


    private function getID($index,$model,$search_feild,$value,$extra_condtion_value = null)
    {
      if($value) // check if it not empty
      {
        if($model == 'Country' OR $model == 'unit_country') // get the result form model
        {
          $ID = Country::where($search_feild,'LIKE','%'.$value)->first();
          $customMsg = __('site.'.strtolower($model)).' '.__('site.not found: recourd').$value.' #['.$index.']';
        }
        if($model == 'City' OR $model == 'unit_city')
        {
          $ID = City::where($search_feild,'LIKE','%'.$value)
                      ->where('country_id',$extra_condtion_value)
                      ->first();
          $customMsg = __('site.'.strtolower($model)).' '.__('site.not found or not related to the country: recourd').$value.' #['.$index.']';
        }

        if($model == 'Project')
        {
          $ID = Project::where($search_feild,'LIKE','%'. $value )->first();
          $customMsg = __('site.project not found: recode').$value.' #['.$index.']';
        }

        if($model == 'last_mile_conversion')
        {
          $ID =  LastMileConversion::where($search_feild,'LIKE','%'.$value)->first();
          $customMsg = __('site.LastMile not found: recode').'['.$index.'] ' ;
        }

        // check if therer is result found or make an errors messge
        if(!$ID){
          $this->errors[] = $customMsg;
        }else{
          return $ID = $ID->id;
        }
      }
    }

    private function addErorr($error)
    {
      $this->errors[] = $error;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
