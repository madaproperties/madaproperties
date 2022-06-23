<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Note;
use Illuminate\Http\Request;
use App\Task;
use App\Notofication;
use App\User;
use App\Contact;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
      if($request->withtask)
      {
        $validate = [
          "description" => "required",
          "date" => "required",
          "contact_id" => "required",
          "time" => "required",
          'type' => 'required'
        ];
        $msg = __('site.create new note with task');
      }else{
        $validate = ['description' => 'required','contact_id' => 'required'];
        $msg = __('site.create new note');
      }

      $data = $request->validate($validate);

      $dataDb = [
        'user_id' => auth()->id(),
        'contact_id' => $request->contact_id,
        'description' => $data['description']
      ];

      $note = Note::create($dataDb);
      if($request->withtask)
      {
        $dataDb['type'] = 'note';
        $dataDb['date'] = date('Y-m-d',strtotime($request->date));
        $dataDb['time'] = date('H:i a',strtotime($request->time));
        $dataDb['type'] = $request->type;
        $data = $dataDb['date'];
        $task = Task::create($dataDb);
      }else {
        $data = '';
      }

      $msg = auth()->user()->name . ' '.$msg;
      $this->newActivity($dataDb['contact_id'],$dataDb['user_id'],$msg,'Note',$note->id,$data);

    
    $contactUrl = route('admin.contact.show',$dataDb['contact_id']);
    
    $lead = Contact::findOrFail($dataDb['contact_id']);
    $description =  
              "<a href='".$contactUrl."'>".$lead->first_name."</a><br>" . $request->description;
           
      if($request->sned_notofication)
      {
        $admins = User::select('id','rule')->where('rule','admin')->get();
        foreach($admins as $admin)
        {
          
            Notofication::create([
              'description' => $description,
              'created_by' => auth()->id(),
              'user_id' => $admin->id
            ]);
          
        }
      }
      
      Contact::where('id',$lead->id)->update([
        'updated_at' => \Carbon\Carbon::now()
      ]);

      return back()->withSuccess(__('site.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $note)
    {
        $note = Note::findOrFail($note);
        $date =$request->validate(['description' => 'required','contact_id' => 'required']);
        $note->update($date);

        return back()->withSuccess(__('site.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
    
   
}
