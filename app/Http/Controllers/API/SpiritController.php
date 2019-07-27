<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Spirit;

class SpiritController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return Spirit::orderBy('drinkName', 'ASC')->paginate(100);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'drinkName'   => 'required',
        'drinkType' => 'required',
      ]);

      $ev = new Spirit($request->all());
      $ev->flagShow = (( ($request['flagShow']===true) ) ? 1 : 0);

      return ($ev->save())
       ? ["message" => "success"]
       : ["message" => "error"];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Spirit::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $spirit = Spirit::findOrFail($id);
      $this->validate($request, [
        'drinkName'   => 'required',
        'drinkType' => 'required',
      ]);

      $spirit->flagShow = (( ($request['flagShow']===true) ) ? 1 : 0);
      return ($spirit->update())
       ? ["message" => "success"]
       : ["message" => "error"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = Spirit::findOrFail($id);

      return ($item->delete())
        ? ["message" => "success"]
        : ["message" => "error"];
    }
}
