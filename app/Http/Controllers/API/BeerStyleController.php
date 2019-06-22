<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BeerStyle;

class BeerStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BeerStyle::latest()->paginate(50);
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
        'beerStyle' => 'required|unique:beerStyles',
        'beerColor' => 'required|min:5',
        'malts'     => 'required|min:5',
        'hops'      => 'required|min:5',
        'bitterness'=> 'required|min:3',
        'ibu_from'  => 'required|integer',
        'ibu_top'   => 'required|integer',
      ]);

      return BeerStyle::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return (BeerStyle::findOrFail($id));
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
        $style = BeerStyle::findOrFail($id);

        $this->validate($request, [
          'beerStyle' => 'required',
          'beerColor' => 'required|min:5',
          'malts'     => 'required|min:5',
          'hops'      => 'required|min:5',
          'bitterness'=> 'required|min:3',
          'ibu_from'  => 'required|integer',
          'ibu_top'   => 'required|integer',
        ]);


        return ($style->update($request->all()))
          ? ['message' => 'style updated'] : ['error' => 'style not updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $style = BeerStyle::findOrFail($id);
        $style->delete();
        return ['message' => 'style deleted'];
    }
}
