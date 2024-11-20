<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   
        $rows = Currency::paginate(20);
        return view('admin.currency.index',[
          'rows' => $rows
        ]);
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
        $data =$request->validate([
          "currency" => "required|max:255",
          "currency_ar" => "required|max:255",
        ]);

        addHistory('Currency',0,'added',$data);

        Currency::create($data);
        return back()->withSuccess(__('site.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
      $currency = Currency::findOrFail($id);
      $data =$request->validate([
        "currency" => "required|max:255",
        "currency_ar" => "required|max:255",
      ]);

      addHistory('Currency',$id,'updated',$data,$currency);

      $currency->update($data);
      return back()->withSuccess(__('site.success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy( $currency)
    {
        $currency = Currency::findOrFail($currency);
        $currency->delete();
        addHistory('Currency',$id,'deleted');     
        return back()->withSuccess(__('site.success'));
    }
}
