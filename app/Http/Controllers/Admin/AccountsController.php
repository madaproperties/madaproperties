<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Hash;
use Mail;
use App\Mail\SetPassword;
use App\Setting;

class AccountsController extends Controller
{

    public function index()
    {
   
        $users = User::all();
        $leaders = User::where('rule','leader')->where('active','1')->get();
        $positions = ['rent','buy','sell','management'];

        return view('admin.accounts.index',[
          'users' => $users,
          'leaders' => $leaders,
          'positions' => $positions,
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
    
        if($data['rule'] == 'salles' OR $data['rule'] == 'sales admin')
        {
            $data['leader']  = $request->leader;
        }else{
            $data['leader']  = null;
         }
 

        $user->update($data);
        return back()->withSuccess(__('site.success'));
    }


    public function destroy(User $user)
    {
        //
    }
}
