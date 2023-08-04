<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{



    public function index()
    {
      if(userRole() == 'other'){
        return redirect()->route('admin.deal.index');      
      }
      //added by fazal 28-05-2023
      elseif(userRole() == 'hr'){
       
        return redirect()->route('admin.employee.index');      
      }
      // added by fazal 18-06-23
      elseif(userRole() == 'it'){
       
        return redirect()->route('admin.madaboard.index');      
      }
      
      return view('home');
    }

    public function login(Request $req)
    {   

        $data = $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $remember_me = ! empty($req->remember); // checkbox remmeber
        $data['active'] = '1';
  
        // check data
        if(auth()->guard()->attempt($data,$remember_me))
        {
          User::where('id',auth()->id())->update([
            'last_login' => Carbon::now()->toDateTimeString()
          ]);
          if(userRole() == 'other'){
            return redirect()->route('admin.deal.index');      
          }
          //
          elseif(userRole() == 'hr'){
             
            return redirect()->route('admin.employee.index');      
          }
        //   added byb fazal 18-06-23
        elseif(userRole() == 'it'){
       
        return redirect()->route('admin.madaboard.index');      
      }
         
          return redirect()->route('admin.');
        }
        // back if notfound
        return back()->with('danger',__('site.notfound or account not active'));
    }

    public function setpassword($hash)
    {
       
      $user = User::where('hash',$hash)->where('active','1')->first();
      if(!$user) abort(404);

      return view('auth.setpassword',compact('user'));
    }

    public function changepassword(Request $req)
    {
        $req->validate([
          'password' => 'required|max:20|confirmed',
          'hash' => 'required'
        ]);
        
        $user = User::where('active','1')->where('hash',$req->hash)->first();
        $password = Hash::make($req->password);
        Auth::login($user);

        $user->update([
          'hash' => Null,
          'password' => $password
        ]);

        User::where('id',auth()->id())->update([
          'last_login' => Carbon::now()->toDateTimeString()
        ]);

        return redirect(route('admin.'));
    }
}
