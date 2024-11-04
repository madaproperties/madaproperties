<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CommercialLeadsImport;

class ImportCommercialLeadsController extends Controller
{
    public function import(Request $req)
    {
      $file = $req->validate([
        'file' => 'required|mimes:xlsx'
      ]);
      $file = Request()->file('file');

      $results = Excel::import(new CommercialLeadsImport,$file);

      return back();
    }
}
