<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Deal;
use App\DealDocuments;
use App\TempFloorPlansDocuments;

class DealDocumentsController extends Controller
{

  function __construct() {
    $this->middleware('permission:deal-create', ['only' => ['upload','tempUpload']]);
  }  

  public function upload(Request $request){
    {
      $html = '';
      $i=0;
      $deal_id = Request('deal_id');
      $documentsName = Request('documentsName');
      $file_type = Request('file_type');
      $document_id = Request('document_id');
  
      if($request->hasFile('documentsNew')) {
        $allowedfileExtension=['pdf','xlsx','xls','doc', 'docx','ppt', 'pptx','txt','png','jpg','jpeg'];
        $files = $request->file('documentsNew');
        $documentIds = [];
        $tempDocIds = [];
        foreach($files as $file){
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $check=in_array($extension,$allowedfileExtension);
          if($check) {
  
            $md5Name = md5_file($file->getRealPath());
            $guessExtension = $file->guessExtension();
            $documentsName = Request('documentsNameNew');
            if(Request('deal_id')){
              $deal_id = Request('deal_id');
              $file = $file->move('public/uploads/deals/'.$deal_id.'/documents', $md5Name.'.'.$guessExtension);     
              $filename = $md5Name.'.'.$guessExtension;
              $destinationPath = 'public/uploads/deals/'.$deal_id.'/documents/'.$filename;
              //Storage::disk('s3')->put('uploads/deals/'.$deal_id.'/documents', $filename);
  
              Storage::disk('s3')->put('uploads/deals/'.$deal_id.'/documents/'.$filename, file_get_contents($destinationPath));
  
              unlink($destinationPath);
  
              DealDocuments::create([
                'deal_id' => $deal_id,
                'document_link' => $filename,
                'file_type' => $file_type,
                'name' => (isset($documentsName[$i]) ? $documentsName[$i] : ''),
              ]);
              $i++;
            }else{
              $file = $file->move('public/uploads/temp', $md5Name.'.'.$guessExtension);     
              $filename = $md5Name.'.'.$guessExtension;
              $destinationPath = 'public/uploads/temp/'.$filename;
  
              $tempDocIds[] = TempFloorPlansDocuments::create([
                'name' => (isset($documentsName[$i]) ? $documentsName[$i] : ''),
                'document_link' => $filename,
                'deal_file_type' => $file_type // document
              ]);
              $i++;
            }
          }
        }
        if($tempDocIds){
          if(\Session::get('dealTempDocIds')){
            $tempDocIds = array_merge($tempDocIds,\Session::get('dealTempDocIds'));
          }
          session()->put('dealTempDocIds', $tempDocIds);
        }
      }
  
      if($request->hasFile('documents')) {
        $allowedfileExtension=['pdf','xlsx','xls','doc', 'docx','ppt', 'pptx','txt','png','jpg','jpeg'];
        $files = $request->file('documents');
        $documentIds = [];
        $i=0;
        foreach($files as $file){
          $filename = $file->getClientOriginalName();
          $extension = $file->getClientOriginalExtension();
          $check=in_array($extension,$allowedfileExtension);
          if($check) {
  
            $md5Name = md5_file($file->getRealPath());
            $guessExtension = $file->guessExtension();
            if(Request('deal_id')){
              $file = $file->move('public/uploads/deals/'.$deal_id.'/documents', $md5Name.'.'.$guessExtension);     
              $filename = $md5Name.'.'.$guessExtension;
              $destinationPath = 'public/uploads/deals/'.$deal_id.'/documents/'.$filename;
              //Storage::disk('s3')->put('uploads/deals/'.$deal_id.'/documents', $filename);
  
              Storage::disk('s3')->put('uploads/deals/'.$deal_id.'/documents/'.$filename, file_get_contents($destinationPath));
  
              unlink($destinationPath);
  
              DealDocuments::where('id',$document_id[$i])->update([
                'name' => $filename,
              ]);
              $i++;
            }
          }
          
        }
        
      }
      $i=0;
      if($documentsName) {
        foreach($documentsName as $name){
            if(isset($document_id[$i])){
              DealDocuments::where('id',$document_id[$i])->update([
                'name' => (isset($documentsName[$i]) ? $documentsName[$i] : '')
              ]);
              $i++;
            }
        }
      }
  
      if($delete_document_id = $request->get('delete_document_id')) {
        foreach($delete_document_id as $key=>$value){
          DealDocuments::where('id',$value)->delete();
        }
      }
  
      return response()->json(['success'=>true,'images'=>'']);
    }
  }

  public function destroy ($id)
  {
    $data = Deal::findOrFail($id);
    $data->delete();
    addHistory('Deal',$id,'deleted');    
    return back()->withSuccess(__('site.success'));
  }
 
}
