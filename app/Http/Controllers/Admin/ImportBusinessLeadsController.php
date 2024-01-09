<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BusinessLeadsImport;

class ImportBusinessLeadsController extends Controller
{
    public function import(Request $req)
    {

      $file = $req->validate([
        'file' => 'required|mimes:xlsx'
      ]);
      $file = Request()->file('file');

      $results = Excel::import(new BusinessLeadsImport,$file);

      return back();
    }
}

