<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactsImport;

class ImportDataController extends Controller
{
    public function import(Request $req)
    {
      $file = $req->validate([
        'file' => 'required|mimes:xlsx'
      ]);
      $file = Request()->file('file');

      $results = Excel::import(new ContactsImport,$file);

      return back();
    }
}
