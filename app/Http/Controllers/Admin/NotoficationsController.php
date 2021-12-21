<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notofication;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Task;
use App\Contact;

class NotoficationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    
      
        $notes = Notofication::select('*')->where('user_id',auth()->id())->orderBy('id','DESC')->get();

        Notofication::where('user_id',auth()->id())->update(['is_read' => '1']);
        
        return view('admin.notofications.index',[
          'notes' => $notes
        ]);
    }

     
    public function switch($id)
    {
        $note = Notofication::findOrFail($id);
   
        $notes = Notofication::where('created_by',$note->created_by)
                                ->where('created_at',$note->created_at)->get();
                                
        $complated = $note->completed == '0'  ? '1' : '0';
        
        foreach($notes as $note):
            $note->update([
                'completed' => $complated
            ]);
        endforeach;
        
        return back()->withSuccess(__('site.success'));
    }
    
}
