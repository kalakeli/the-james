<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Brewery;

class BreweryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Brewery::latest()->paginate(50);
        return Brewery::orderBy('brewery', 'ASC')->latest()->paginate(100);
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
        'brewery'   => 'required|unique:breweries',
        'breweryLong' => 'required|min:5',
        'breweryAddress' => 'required|min:5',
        'breweryUrl' => 'required|min:5',
        'country' => 'required|min:3'
      ]);

      return Brewery::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Brewery::findOrFail($id);
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
      $brewery = Brewery::findOrFail($id);
      $this->validate($request, [
        'brewery'   => 'required',
        'breweryLong' => 'required|min:5',
        'breweryAddress' => 'required|min:5',
        'breweryUrl' => 'required|min:5',
        'country' => 'required|min:3'
      ]);

      return ($brewery->update($request->all()))
        ? ['message' => 'item updated'] : ['error' => 'item not updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = Brewery::findOrFail($id);
      $item->delete();
      return ['message' => 'brewery deleted'];
    }
}
