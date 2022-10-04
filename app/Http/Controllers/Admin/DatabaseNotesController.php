<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DatabaseNote;
use Illuminate\Http\Request;
use App\Task;
use App\Notofication;
use App\User;
use App\DatabaseRecords;

class DatabaseNotesController extends Controller
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
      $validate = ['description' => 'required','database_id' => 'required'];
      $msg = __('site.create new note');
      $data = $request->validate($validate);

      $dataDb = [
        'user_id' => auth()->id(),
        'database_id' => $request->database_id,
        'description' => $data['description']
      ];

      addHistory('Currency',0,'added',$dataDb);
   
      $note = DatabaseNote::create($dataDb);
    
      $lead = DatabaseRecords::findOrFail($dataDb['database_id']);
      DatabaseRecords::where('id',$lead->id)->update([
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
    public function update(Request $request,  $id)
    {
        $note = DatabaseNote::findOrFail($id);
        $data =$request->validate(['description' => 'required','database_id' => 'required']);


        addHistory('Database Note',$id,'updated',$data,$note);

        $note->update($data);

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
