<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Hrnotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;

class AccountController extends Controller
{

    public function index()
    {
        // added by fazal 28-5-23
        if(userRole()=='hr')
        {
            if(auth()->user()->time_zone=='Asia/Dubai')
            {
            $notification_count=Hrnotification::where('status',1)->where('location','dubai')->count();    
            }
            else
            {
             $notification_count=Hrnotification::where('status',1)->where('location','saudi')->count();   
            }
            return view('admin.account.index',compact('notification_count'));    
        }
        
        return view('admin.account.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $user)
    {
        $user = User::findOrFail(auth()->id());
        $data = $request->validate([
          'name' => 'nullable|max:255',
          'password' => 'nullable|confirmed',
          'time_zone'  => 'nullable',
          'lang' => 'required'
        ]);
        $data['password'] = $user->password;
        
       if(!empty($request->password))
        {
          $data['password'] = Hash::make($request->password);
        }


        addHistory('User',auth()->id(),'updated');
        
        $user->update($data);
        return back()->withSuccess(__('site.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
