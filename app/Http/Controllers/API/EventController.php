<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Event::orderBy('eventStart', 'DESC')->latest()->paginate(100);
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
        'eventShort'   => 'required|min:5',
        'eventLong' => 'required|min:5',
        'eventType' => 'required',
        'eventStart' => 'required:date',
        'eventEnd' => 'required:date',
      ]);

      $ev = new Event($request->all());
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
        return Event::findOrFail($id);
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
        $ev = Event::findOrFail($id);
        $this->validate($request, [
          'eventShort'   => 'required|min:5',
          'eventLong' => 'required|min:5',
          'eventType' => 'required'
        ]);

        $ev->flagShow = (( ($request['flagShow']===true) ) ? 1 : 0);
        return ($ev->update())
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
      $item = Event::findOrFail($id);

      return ($item->delete())
        ? ["message" => "success"]
        : ["message" => "error"];
    }
}
