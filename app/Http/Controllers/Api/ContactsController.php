<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponses;
use App\Country;
use App\City;
use App\User;
use App\Project;
use App\LastMileConversion;
use App\Status;
use Carbon\Carbon;

class ContactsController extends Controller
{
    use ApiResponses;

 private $validateAttribute = [
              
            ];

    private $errors;
    private $rules = [
          "email"                 => "nullable|email",
          "first_name"            => "required|max:255",
          "last_name"             => "nullable|max:255",
          "country"            => "required|max:255",
          "city"               => "nullable|max:255",
          "phone"                 => "required|max:20",
          "scound_phone"          => "nullable|max:20",
          "project_id"            => "nullable|max:100",
          "mile_id"               => "nullable|max:255",
          "campaign"              => "nullable|max:255",
          "source"                => "nullable|max:255",
          "medium"                => "nullable|max:255",
          "budget"                => "nullable|max:255",
          'lang'                  => "nullable|max:255",
          'lead_type'             => "nullable|max:255",
          'currency'              => "nullable|max:255",
          "purpose"               => "required|max:255",
          "purpose_type"          => "nullable|max:255",
          "unit_country"          => "nullable|max:255",
          "unit_city"             => "nullable|max:255",
          'country_fromat'        =>'nullable',
          "last_mile_conversion"  => "nullable|max:255",
          "unit_zone"             => "nullable|max:255",
          'content' => 'nullable|max:255',
          'assignedto'           => "nullable|max:255|exists:users,id",
          'campaign_country'           => "nullable",
          'deal_ip'           => "nullable",
          'scound_phone'           => "nullable",
          'form_id'           => "nullable",
          'subject'           => "nullable",
          'ip'           => "nullable",
          'utm_source'           => "nullable",
          'utm_medium'           => "nullable",
          'utm_campaign'           => "nullable",
          'utm_content'           => "nullable",
          'phone_number'           => "nullable",
          'privacy_policy'           => "nullable",
          'last_mile'           => "nullable",
          'message'           => "nullable",
        ];
        
      

    public function __construct()
    {
        $this->middleware('jwt.auth');
    }

    public function store(Request $request)
    {
          
        $auth_user = auth('api')->user();
        $auth_user_id = $auth_user->id;
    
        $validator = Validator::make($request->all(), $this->rules);
        
        
        $errors = [];

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->returnError($errors,count($errors));
        }
        
        foreach($request->all() as $key => $val)
        {
            if(!in_array($key,array_keys($this->rules)))
            {
                $this->addErorr("UNKNOWN Feild ". $key);
            }
            
        }
        
       
        $contact = $request->only(array_keys($this->rules));
  
            
        if(isset($contact['country_fromat']))
        {
            $contact['country']  =  code_to_country( $contact['country'] );
        }
        
        
        unset($contact['country_fromat']);
      
        
        // check if lead exsist before in the same team 
            if($auth_user == 'leader')
            {
                $leader = $auth_user->id;    
            }
        
           
             $leader = $auth_user->rule == 'leader' ? $auth_user->id :  $auth_user->leader;
            
            if($leader)
            {
                $leaderUsers = User::where('leader',$leader)->OrWhere('id', $leader)->get()->pluck('id')->toArray();
              
                
         $countryCode = Country::where('name_en',$contact['country'])->first();
        $countryCode = $countryCode ? $countryCode->id : null;
       
        
             if(userRole() == 'sales admin')
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
                    if(isset($contact['status_id']) AND  newStatus()->id != $contact['status_id']){
                    $updaetDate['status_id'] = newStatus()->id;
                    $updaetDate['status_changed_at'] = Carbon::now();
                     $action = __('site.status changed to').' '.newStatus()->name;
                
                newActivity($checkcontact->id,auth()->id(),$action,null,null, null,true);
                $checkcontact->update($updaetDate);
                    }
            
                    // create activity 
                    $action = __('site.tried to enter contact agian');
                    newActivity($checkcontact->id,auth()->id(),$action);
                    // back with messge 
                 
                    
                    
                    $this->addErorr(__('site.leader exists before') . ' #'.$checkcontact->phone);
                }
                
            }
        
        // validate countrey , city
        // validate assigned to, crteated at 
        
        
          // Get ID's
            $index = 1;
            if(isset($contact['country']))
            {
              $country_id = $this->getID('','Country','',$contact['country']);
              $contact['country_id'] = $country_id;
            }
            // check if he pass the city id 
            if(isset($contact['city']))
            {
                $city_id = $this->getID('','City','',$contact['city'],$contact['country_id']);
                $contact['city_id'] = $city_id;
            }

            if(isset($contact['project_id']))
            {
            $project_id =  $this->getID('','Project','',$contact['project_id']);
            $contact['project_id'] = $project_id;
            }

            if(isset($contact['last_mile_conversion']))
            {
               $last_mile_conversion = $this->getID('','last_mile_conversion','',$contact['last_mile_conversion']);
              $contact['last_mile_conversion'] = $last_mile_conversion;
            }

            if(isset($contact['unit_country']))
            {
              $unit_country = $this->getID('','unit_country','',$contact['unit_country']);
              $contact['unit_country'] = $unit_country;
            }

            if(isset($contact['unit_city']))
            {
              $unit_city = $this->getID('','unit_city','',$contact['unit_city'],$contact['unit_country']);
             $contact['unit_city'] = $unit_city;
            }

            // if there is assigned to will be the smae value - atherwise will be the uploder
            $contact['user_id'] = !empty($contact['assignedto']) ? $contact['assignedto'] : $auth_user_id;

            
            if($contact['user_id'] != $auth_user_id  AND $auth_user->rule != 'admin') // check if he assigned to anther one i have to check if the currentauth is the leader
            {
               
              $checkAssigned = User::where('id',$contact['user_id'])
                                    ->where('leader',$auth_user_id)->first();
    
                    if(!$checkAssigned AND $auth_user->rule == 'leader')
                    {
                     $this->addErorr(__('site.you are not leader for user numbers').' ['. $contact['user_id'].']');
                    }

            }
            
            
            if($auth_user->rule == 'sales admin')
            {
              $user = User::where('id',$contact['user_id'])->first();
                
                if($user->leader  != $auth_user->leader AND $user->id != $auth_user->leader)
                {
                //  $this->addErorr(__('site.you are not leader for user').' ['. $contact['user_id'].']');
                }
            }
            
            unset($contact['country']);
            unset($contact['city']);
            
            $contact['created_by'] = $auth_user_id; // assigned created by for the currunt auth
         
            
            // check if he has postion  
            $contact_purpose = $contact['purpose'];
            $user_position_types = json_decode(auth()->user()->position_types);
            
            if(! in_array($contact_purpose, $user_position_types) OR  !$contact_purpose)
            {
              $this->addErorr(__('site.you are not allowed to create that purpose ').'#['. $index . ']');
            }

          // found some errors 
        
          
          $status = Status::where('name_en','LIKE','%'. 'New' . '%')->first();
          if(empty($status))
          {
            $status = Status::create([
              'name_ar' => 'جديد',
              'name_en' => 'New',
              'active' => '1'
            ]);
          }
            
          
        
        $contact['status_id'] = $status->id;
       
        $contact['created_from'] = 'api';
    
        if($this->errors)
         {
            return $this->returnError($this->errors,count($this->errors));
         }else{

			//Added by Javed on 28-03-2022
            if(isset($contact['unit_country']) && $contact['unit_country'] == 1){
              $contact['user_id'] = '28';
            }
			//End
            //Added by Javed on 10-04-2022
            if(isset($project_id)){
              $projectData = Project::where('id',$project_id)->first();
              if(!isset($contact['unit_country']) && isset($projectData->country_id)){
                $contact['unit_country'] = $projectData->country_id;
              }
              if(isset($projectData->country_id) && $projectData->country_id == 1){
                $contact['user_id'] = '28';
                $contact['created_by'] = '32';
              }
            }
            //End
          
			if(isset($contact['user_id']) && $contact['user_id'] == '28'){
			  $contact['created_by'] = '32'; // lead-admin-ksa@madaproperties.com
			}else if(isset($contact['user_id']) && $contact['user_id'] == '68'){
			  $contact['created_by'] = '33'; // lead-admin-uae@madaproperties.com
			}

            // if there is assigned to will be the smae value - atherwise will be the uploder
            if(!empty($contact['assignedto'])){
                $contact['user_id'] = $contact['assignedto'];
            }
            unset($contact['assignedto']); // remove asssigned to => replaced with user_id

		 $contact = Contact::create($contact);

            $action = __('site.contact created');
            $this->newActivity($contact->id,auth('api')->id(),$action,'Contact',$contact->id,null,true);
    
            return $this->returnData($contact,'Created successfully');
         }
        
    }

    // GET ID FORM NAME_EN
    private function getID($index = 1,$model,$search_feild = 'name_en',$value,$extra_condtion_value = null)
    {
      $index = empty($index) ? 1 :  $index;
      $search_feild = $search_feild == '' ? 'name_en' : $search_feild;

      if($value) // check if it not empty
      {
        if($model == 'Country' OR $model == 'unit_country') // get the result form model
        {

			$ID = Country::where($search_feild,'LIKE','%'. $value . '%')->first();
			$customMsg = __('site.'.strtolower($model)).' '.__('site.not found: recourd').' ['.$index.']';
        }
        if($model == 'City' OR $model == 'unit_city')
        {
          $ID = City::where($search_feild,'LIKE','%' . $value . '%')
                      ->where('country_id',$extra_condtion_value)
                      ->first();
          $customMsg = __('site.'.strtolower($model)).' '.__('site.not found or not related to the country: recourd').'['.$index.']';
        }

        if($model == 'Project')
        {
          //$ID = Project::where($search_feild,'LIKE','%'. $value . '%')->first();
          $ID = Project::where($search_feild,$value)->first();
          $customMsg = __('site.project not found: recode').' ['.$index.']';
        }

        if($model == 'last_mile_conversion')
        {
          $ID =  LastMileConversion::where($search_feild,'LIKE','%' . $value . '%')->first();
          $customMsg = __('site.LastMile not found: recode').' ['.$index.']';
        }

        // check if therer is result found or make an errors messge
        if(!$ID){
          $this->errors[] = $customMsg;
        }else{
          return $ID = $ID->id;
        }
      }
    }
    // ADD NEW ERROR 
    private function addErorr($error)
    {
      $this->errors[] = $error;
    }

    
}
