<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Hash;
use Mail;
use App\Mail\SetPassword;
use App\Setting;
use Spatie\Permission\Models\Role;
use App\Country;
use Illuminate\Support\Facades\Storage;

class AccountsController extends Controller
{

    public function index()
    {
        // added by fazal
        if(userRole()=='it')
        {
            $userloc=User::where('id',auth()->id())->first();

            if($userloc->time_zone=='Asia/Riyadh')
            {
               
              if(Request()->has('active') && (Request('active') == '0' || Request('active') == '1')){

                    $users = User::where('active',Request('active'))->where('time_zone','Asia/Riyadh');

                    $users_count = User::where('active',Request('active'))->where('time_zone','Asia/Riyadh');
                    if(Request()->has('search')){
                        $users = $users->where('email','LIKE','%'. Request('search') .'%')->where('time_zone','Asia/Riyadh');
                        $users_count = $users->where('email','LIKE','%'. Request('search') .'%')->where('time_zone','Asia/Riyadh');
                    }
                    $users = $users->paginate(20);
                    $users_count = $users_count->count();
                }else{

                    if(Request()->has('search')){
                        $users = User::where('email','LIKE','%'. Request('search') .'%')->where('time_zone','Asia/Riyadh')->paginate(20);
                        $users_count = User::where('email','LIKE','%'. Request('search') .'%')->where('time_zone','Asia/Riyadh')->count();
                    }else{
                        $users = User::where('time_zone','Asia/Riyadh')->paginate(20);
                        $users_count = User::where('time_zone','Asia/Riyadh')->count();
                    }
                } 
                $leaders = User::whereIn('rule',['leader','sales director','commercial leader','business developement leader'])->where('active','1')->where('time_zone','Asia/Riyadh')->get(); 
            }else{
                    
                if(Request()->has('active') && (Request('active') == '0' || Request('active') == '1')){

                    $users = User::where('active',Request('active'))->where('time_zone','Asia/Dubai');
                    $users_count = User::where('active',Request('active'))->where('time_zone','Asia/Dubai');
                    if(Request()->has('search')){
                        $users = $users->where('email','LIKE','%'. Request('search') .'%')->where('time_zone','Asia/Dubai');
                        $users_count = $users->where('email','LIKE','%'. Request('search') .'%')->where('time_zone','Asia/Dubai');
                    }
                    $users = $users->paginate(20);
                    $users_count = $users_count->count();
                }else{
                    if(Request()->has('search')){
                        $users = User::where('email','LIKE','%'. Request('search') .'%')->where('time_zone','Asia/Dubai')->paginate(20);
                        $users_count = User::where('email','LIKE','%'. Request('search') .'%')->where('time_zone','Asia/Dubai')->count();
                    }else{
                        $users = User::where('time_zone','Asia/Dubai')->paginate(20);
                        $users_count = User::where('time_zone','Asia/Dubai')->count();
                    }
                }  
                $leaders = User::whereIn('rule',['leader','sales director','commercial leader','business developement leader'])->where('active','1')->where('time_zone','Asia/Dubai')->get(); 
            }
        }else{
            if(Request()->has('active') && (Request('active') == '0' || Request('active') == '1')){
                $users = User::where('active',Request('active'));
                $users_count = User::where('active',Request('active'));
                if(Request()->has('search')){
                    $users = $users->where('email','LIKE','%'. Request('search') .'%');
                    $users_count = $users->where('email','LIKE','%'. Request('search') .'%');
                }
                $users = $users->paginate(20);
                $users_count = $users_count->count();
            }else{
                if(Request()->has('search')){
                    $users = User::where('email','LIKE','%'. Request('search') .'%')->paginate(20);
                    $users_count = User::where('email','LIKE','%'. Request('search') .'%')->count();
                }else{
                    $users = User::paginate(20);
                    $users_count = User::count();
                }
            }  
            $leaders = User::whereIn('rule',['leader','sales director','commercial leader','business developement leader'])->where('active','1')->get(); 
        }
        $countries = Country::orderBy('name_en')->get();
        $collectCounties = [];
        $collectCounties = collect($collectCounties);
        foreach($countries as $index => $country) {
            if(in_array($country->name_en,toCountriess()) ) {
                $collectCounties->push($country);
            }
        }
        $countries = $countries->filter(function($item) {
          return !in_array($item->name_en,toCountriess());
        });
        foreach($collectCounties as $topCountry) {
            $countries->prepend($topCountry);
        }        

        
        $positions = ['rent','buy','sell','management','handover','TC Renewal','Conveyance'];
        $roles = Role::pluck('name','name')->all();

        $reraUsers = User::where('active','1')->where('is_rera_active','1')->get();

        return view('admin.accounts.index',[
          'users' => $users,
          'leaders' => $leaders,
          'positions' => $positions,
          'roles' => $roles,
          'users_count' => $users_count,
          'countries' => $countries,
          'reraUsers' => $reraUsers
        ]);
    }

    public function store(Request $request) {
        $data = $request->validate([
          'email' => 'required|unique:users',
          'rule' => 'required',
          'leader' => 'nullable',
          'leaders' => 'nullable',
          'time_zone' => 'nullable',
          'username' => 'nullable',
          'employee_id' => 'nullable',
          'nationality' => 'nullable',
          'mobile_no' => 'nullable',
          'department' => 'nullable',
          'designation' => 'nullable',
          'user_pic' => 'nullable',
          'position_types' => 'required|array',
          'is_rera_active' => 'nullable',
          'rera_number' => 'nullable',
          'rera_user_id' => 'nullable',
           'public_profile' =>'nullable', // added by fazal on 20-10-23
        ]);

        unset($data['position_types']);
        unset($data['leader']);
        unset($data['leaders']);
        $hash = str_replace('/','',Hash::make(rand(1,100000)));
        $data['hash'] = $hash;
        // set target numbers
        target_settings();  

        $data['target_call'] = get_target_byname('call')->value;
        $data['target_email'] = get_target_byname('email')->value;
        $data['target_meeting'] = get_target_byname('meeting')->value;
        $data['target_whatsapp'] = get_target_byname('whatsapp')->value;
        
        if( !in_array($data['time_zone'],  timeZones()) ) {
            $data['time_zone'] = timeZones()[0];
        }
        if($request->file('user_pic')){
            if($request->file('user_pic')){
                $file = Storage::disk('s3')->putFile('uploads/users', $request->file('user_pic'));
                $path="https://mada-crm-live.s3.me-south-1.amazonaws.com/".$file;  
                $data['user_pic'] = $path;
            }
        }
     
        addHistory('User',0,'added',$data);
        
        $user = User::create($data);
        if($data['rule'] == 'sales'){
            $data['rule']  = 'sales';
        }
        $user->assignRole($data['rule']);
        $user->update([
          'position_types' => $request->position_types,
          'leader' => json_encode($data['rule'] != 'assistant sales director' ? [$request->leader] : $request->leaders)
        ]);
        try {
            //Mail::to($data['email'])->send(new SetPassword($data));
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
        return back()->withSuccess(__('site.success'));
    }


    public function update(Request $request, $id)
    {
        
       
        $user = User::findOrFail($id);
        
        $data = $request->validate([
          'email' => 'required|unique:users,email,'.$user->id,
          'rule' => 'required',
          'leader' => 'nullable',
          'password' => 'nullable|max:20',
          'active' => 'required',
          'position_types' => 'required|array',
          'target_email' => 'nullable',
          'target_call' => 'nullable',
          'target_meeting' => 'nullable',
          'target_whatsapp' => 'nullable',
          'time_zone' => 'nullable',
          'username' => 'nullable',
          'employee_id' => 'nullable',
          'nationality' => 'nullable',
          'mobile_no' => 'nullable',
          'department' => 'nullable',
          'designation' => 'nullable',
          'user_pic' => 'nullable',
          'is_rera_active' => 'nullable',
          'rera_number' => 'nullable',
          'rera_user_id' => 'nullable',
          'public_profile' =>'nullable', // added by fazal on 20-10-23
        ]);
        $data['public_profile']= $request->has('public_profile') ? $request->input('public_profile') : 0;   // added by fazal on 20-10-23
        
        $data['password'] = $user->password;
        
        if(!empty($request->password))
        {
          $data['password'] = Hash::make($request->password);
        }
        
        // set Leader To Null if rule not salles
        
        if($data['rule'] == 'sales' || $data['rule'] == 'sales admin' || $data['rule'] == 'commercial sales' || $data['rule'] == 'business developement sales')
        {
            $data['leader']  = json_encode([$request->leader]);
        } elseif($data['rule'] == 'assistant sales director') {
            $data['leader']  = json_encode($request->leaders);
        }else{
            $data['leader']  = json_encode(['0']);
        }
        if($request->file('user_pic')) {
            if($request->file('user_pic')) {
                $file = Storage::disk('s3')->putFile('uploads/users', $request->file('user_pic'));
                $path="https://mada-crm-live.s3.me-south-1.amazonaws.com/".$file;      
                $data['user_pic'] = $path;
            }
        }

        addHistory('User',$id,'updated',$data,$user);
       
        $user->update($data);
        if($data['rule'] == 'sales'){
            $data['rule']  = 'sales';
        }
        \DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($data['rule']);
        return back()->withSuccess(__('site.success'));
    }


    public function destroy($id)
    {
        $contact = User::findOrFail($id);
        $contact->delete();
        addHistory('User',$id,'deleted');        
        return back()->withSuccess(__('site.success'));
    }
    

    public function getDetailsByAjax(Request $request){
        $user=User::findOrFail($request->get('id'));
        
        if($user->leader) {
            $user->leader = json_decode($user->leader, true);
        }

        $countries = Country::orderBy('name_en')->get();
        $collectCounties = [];
        $collectCounties = collect($collectCounties);
        foreach($countries as $index => $country) {
            if(in_array($country->name_en,toCountriess()) ) {
                $collectCounties->push($country);
            }
        }
        $countries = $countries->filter(function($item) {
          return !in_array($item->name_en,toCountriess());
        });
        foreach($collectCounties as $topCountry) {
            $countries->prepend($topCountry);
        }        

        $leaders = User::whereIn('rule',['leader','sales director','commercial leader','business developement leader'])->where('active','1')->get();
        $reraUsers = User::where('active','1')->where('is_rera_active','1')->get();

        $positions = ['rent','buy','sell','management','handover','TC Renewal','Agent','Conveyance'];
        $roles = Role::pluck('name','name')->all();

        return view('admin.accounts.viewModal',[
            'user' => $user,
            'leaders' => $leaders,
            'positions' => $positions,
            'roles' => $roles,
            'countries' => $countries,
            'reraUsers' => $reraUsers
          ]);
    }  
    
}
