<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\CommercialNote;
use Illuminate\Http\Request;
use App\CommercialTask;
use App\Notofication;
use App\User;
use App\Commercial;
use App\Project;

class CommercialNotesController extends Controller
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
          "commercial_id" => "required",
          "time" => "required",
          'type' => 'required'
        ];
        $msg = __('site.create new note with task');
      }else{
        $validate = ['description' => 'required','commercial_id' => 'required'];
        $msg = __('site.create new note');
      }

      $data = $request->validate($validate);

      $dataDb = [
        'user_id' => auth()->id(),
        'commercial_id' => $request->commercial_id,
        'description' => $data['description']
      ];

      $note = CommercialNote::create($dataDb);
      if($request->withtask)
      {
        $dataDb['type'] = 'note';
        $dataDb['date'] = date('Y-m-d',strtotime($request->date));
        $dataDb['time'] = date('H:i a',strtotime($request->time));
        $dataDb['type'] = $request->type;
        $data = $dataDb['date'];
        $dataDb['date'] = \Carbon\Carbon::parse(str_replace('-','/',$request->date))->format('Y-m-d'); 
        $task = CommercialTask::create($dataDb);
      }else {
        $data = '';
      }

      $msg = auth()->user()->name . ' '.$msg;
      $this->newCommercialActivity($dataDb['commercial_id'],$dataDb['user_id'],$msg,'Note',$note->id,$request->date);

    
    $contactUrl = route('admin.commercial-leads.show',$dataDb['commercial_id']);
    
    $lead = Commercial::findOrFail($dataDb['commercial_id']);
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
        
        $projectData = Project::find($lead->project_id);
        if(isset($projectData->country_id)){
          if($projectData->country_id == 1){
            $admins = User::select('id','rule')->where('rule','sales admin saudi')->get();
            foreach($admins as $admin){
                Notofication::create([
                  'description' => $description,
                  'created_by' => auth()->id(),
                  'user_id' => $admin->id
                ]);
            }

          }elseif($projectData->country_id == 2){
            $admins = User::select('id','rule')->where('rule','sales admin uae')->get();
            foreach($admins as $admin){
              Notofication::create([
                'description' => $description,
                'created_by' => auth()->id(),
                'user_id' => $admin->id
              ]);
            }
          }
        }
        
      }
      
      Commercial::where('id',$lead->id)->update([
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
        $date =$request->validate(['description' => 'required','commercial_id' => 'required']);
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
