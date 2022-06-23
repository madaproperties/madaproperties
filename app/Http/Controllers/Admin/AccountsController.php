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

class AccountsController extends Controller
{

    public function index()
    {
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
                    
        $leaders = User::where('rule','leader')->where('active','1')->get();
        $positions = ['rent','buy','sell','management','handover'];
        $roles = Role::pluck('name','name')->all();
        return view('admin.accounts.index',[
          'users' => $users,
          'leaders' => $leaders,
          'positions' => $positions,
          'roles' => $roles,
          'users_count' => $users_count
        ]);
    }




    public function store(Request $request)
    {
        
        $data = $request->validate([
          'email' => 'required|unique:users',
          'rule' => 'required',
          'leader' => 'nullable',
          'time_zone' => 'nullable',
          'position_types' => 'required|array'
        ]);

        unset($data['position_types']);
        $hash = str_replace('/','',Hash::make(rand(1,100000)));
        $data['hash'] = $hash;
        // set target numbers
        target_settings();  

        $data['target_call'] = get_target_byname('call')->value;
        $data['target_email'] = get_target_byname('email')->value;
        $data['target_meeting'] = get_target_byname('meeting')->value;
        $data['target_whatsapp'] = get_target_byname('whatsapp')->value;
        
        if( !in_array($data['time_zone'],  timeZones()) )
        {
            $data['time_zone'] = timeZones()[0];
        }
     
        
        $user = User::create($data);
        if($data['rule'] == 'sales'){
            $data['rule']  = 'sales';
        }
        $user->assignRole($data['rule']);
        $user->update([
          'position_types' => $request->position_types
        ]);

        Mail::to($data['email'])->send(new SetPassword($data));
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
        ]);
        
        
        $data['password'] = $user->password;
        
        if(!empty($request->password))
        {
          $data['password'] = Hash::make($request->password);
        }
        
        // set Leader To Null if rule not salles
    
        if($data['rule'] == 'sales' OR $data['rule'] == 'sales admin')
        {
            $data['leader']  = $request->leader;
        }else{
            $data['leader']  = null;
         }
 

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
        return back()->withSuccess(__('site.success'));
    }
}
