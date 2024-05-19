<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use App\Madaboard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class MadaboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
     {
        $this->middleware('permission:mada-board-create',  ['only' => ['create','store']]);
          $this->middleware('permission:mada-board-list',  ['only' => ['index']]);
          $this->middleware('permission:mada-board-edit', ['only' => ['show','edit']]);
          
     }  
    public function index()
    {  
        // dd('hit');

     $datas=Madaboard::get();

     return view('admin.mada_board.index',compact('datas'));
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
      return view('admin.mada_board.create');  
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
        
    public function store(Request $request)
  {
       $data = $request->validate([
        "title"          => "required|max:191",
        "image"         => "required",
        
      ]);
      $data['created_at'] = Carbon::now();

       
       if($request->file('image')){
        
        $md5Name = md5_file($request->file('image')->getRealPath());
        $guessExtension = $request->file('image')->guessExtension();
       
        $file = Storage::disk('s3')->putFile('uploads/mada_board', $request->file('image'));
       
      //  $path="https://mada-properties-live.s3.eu-west-1.amazonaws.com/".$file;
       $path= $path="https://mada-crm-live.s3.me-south-1.amazonaws.com/".$file;

        if($guessExtension=='jpg'||$guessExtension=='png'||$guessExtension=='jpeg' )
        {
        $data['type']='image';
            
        }  
        else{
          $data['type']='video';
          // dd( $data['type']);
        }   
      
        $data['image'] = $path;

      }
      // dd($data);
       Madaboard::create($data);
      $datas=Madaboard::get();
      return redirect(route('admin.madaboard.index',compact('datas')))->withSuccess(__('site.success'));
  }
   

  
    public function show($id)
    {
        $data = Madaboard::findOrFail($id);
    return view('admin.mada_board.show',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $mada_data= Madaboard::findOrFail($id);

      $data = $request->validate([
        "title"          => "nullable",
        "image"         => "nullable",
        
      ]);
      $data['created_at'] = Carbon::now();

      if($request->file('image')){
        
        $md5Name = md5_file($request->file('image')->getRealPath());
        $guessExtension = $request->file('image')->guessExtension();
       
        $file = Storage::disk('s3')->putFile('uploads/mada_board', $request->file('image'));
       
       // $path="https://mada-properties-live.s3.eu-west-1.amazonaws.com/".$file;
       $path= $path="https://mada-crm-live.s3.me-south-1.amazonaws.com/".$file;
       

        if($guessExtension=='jpg'||$guessExtension=='png'||$guessExtension=='jpeg' )
        {
        $data['type']='image';
            
        }  
        else{
          $data['type']='video';
          // dd( $data['type']);
        }   
      
        $data['image'] = $path;

      }
      $mada_data->update($data); 
      $datas=Madaboard::get();
      return redirect(route('admin.madaboard.index',compact('datas')))->withSuccess(__('site.success'));  
     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $data = Madaboard::findOrFail($id);
    $data->delete();   
    return back()->withSuccess(__('site.success'));
    }
    public function slider()
    {
        $datas=Madaboard::get();
       return view('admin.mada_board.slide',compact('datas'));   
    }
}
