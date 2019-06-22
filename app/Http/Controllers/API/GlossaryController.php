<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Glossary;

class GlossaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Glossary::orderBy('term', 'ASC')->latest()->paginate(100);
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
        'term'   => 'required|unique:glossary',
        'explanation' => 'required|min:5'
      ]);

      return Glossary::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Glossary::findOrFail($id);
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
        $item = Glossary::findOrFail($id);
        $this->validate($request, [
          'term'   => 'required|unique:glossary,term,'.$id,
          'explanation' => 'required|min:5'
        ]);
        $item->term = $request['term'];
        $item->explanation = $request['explanation'];
        $item->furtherInfoName = $request['furtherInfoName'];
        $item->furtherInfoLink = $request['furtherInfoLink'];
        $item->flagShow = (( ($request['flagShow']===true) || ($request['flagShow']===1) ) ? 1 : 0);

        return ($item->update())
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
        $item = Glossary::findOrFail($id);
        return ($item->delete())
          ? ["message" => "success"]
          : ["message" => "error"];
    }
}
