<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Beer;

class BeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $beers = \DB::table('beers')
            ->join('breweries', 'breweries.id', '=', 'beers.breweryID')
            ->join('beerStyles', 'beers.beerStyleID', '=', 'beerStyles.id')
            ->select('beers.*', 'breweries.brewery as brewery', 'beerStyles.beerStyle')
            ->orderBy('beers.beer', 'ASC')
            ->get();
      return ($beers);
        // return Beer::orderBy('beer', 'ASC')->latest()->paginate(100);
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
          'beer' => 'required|unique:beers',
          'breweryID' => 'required',
          'beerStyleID'  => 'required',
          'alcohol'  => 'required',
          'fermentation'  => 'required',
          'hops' => 'required',
          'malts' => 'required',
          'beerColour'  => 'required',
          'beerAroma'  => 'required:min:5',
          'flagCask' => 'required_without_all:flagKeg,flagBottle',
          'flagKeg' => 'required_without_all:flagCask,flagBottle',
          'flagBottle' => 'required_without_all:flagCask,flagKeg'
        ]);
        $beer = new Beer($request->all());
        $beer->flagCask = (( ($request['flagCask']===true) ) ? 1 : 0);
        $beer->flagKeg = (( ($request['flagKeg']===true)  ) ? 1 : 0);
        $beer->flagBottle = (( ($request['flagBottle']===true)  ) ? 1 : 0);
        $beer->flagSoon = (( ($request['flagSoon']===true)  ) ? 1 : 0);
        $beer->flagLastCask = (( ($request['flagLastCask']===true)  ) ? 1 : 0);
        $beer->flagShow = (( ($request['flagShow']===true) ) ? 1 : 0);

        return ($beer->save())
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
      $theBeer = \DB::table('beers')
            ->join('breweries', 'breweries.id', '=', 'beers.breweryID')
            ->join('beerStyles', 'beers.beerStyleID', '=', 'beerStyles.id')
            ->select('beers.*', 'breweries.brewery as brewery', 'beerStyles.beerStyle')
            ->where('beers.id', '=', $id)
            ->get();
      return $theBeer;
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
      $beer = Beer::findOrFail($id);
    // dd($beer);
      $this->validate($request, [
        'beer' => 'required|unique:beers,beer,'.$id,
        'breweryID' => 'required',
        'beerStyleID'  => 'required',
        'alcohol'  => 'required',
        'fermentation'  => 'required',
        'hops' => 'required',
        'malts' => 'required',
        'beerColour'  => 'required',
        'beerAroma'  => 'required:min:5',
        'flagCask' => 'required_without_all:flagKeg,flagBottle',
        'flagKeg' => 'required_without_all:flagCask,flagBottle',
        'flagBottle' => 'required_without_all:flagCask,flagKeg'
      ]);
      $beer->beer = $request['beer'];
      $beer->breweryID = $request['breweryID'];
      $beer->beerStyleID = $request['beerStyleID'];
      $beer->alcohol = $request['alcohol'];
      $beer->fermentation = $request['fermentation'];
      $beer->hops = $request['hops'];
      $beer->malts = $request['malts'];
      $beer->beerColour = $request['beerColour'];
      $beer->beerAroma = $request['beerAroma'];
      $beer->iconPath = $request['iconPath'];
      $beer->iconCredits = $request['iconCredits'];
      $beer->flagCask = (( ($request['flagCask']===true) || ($request['flagCask']===1)  ) ? 1 : 0);
      $beer->flagKeg = (( ($request['flagKeg']===true) || ($request['flagKeg']===1)  ) ? 1 : 0);
      $beer->flagBottle = (( ($request['flagBottle']===true) || ($request['flagBottle']===1)  ) ? 1 : 0);
      $beer->flagSoon = (( ($request['flagSoon']===true) || ($request['flagSoon']===1)  ) ? 1 : 0);
      $beer->flagLastCask = (( ($request['flagLastCask']===true) || ($request['flagLastCask']===1)  ) ? 1 : 0);
      $beer->flagShow = (( ($request['flagShow']===true) || ($request['flagShow']===1) ) ? 1 : 0);

      return ($beer->update())
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
        $item = Beer::findOrFail($id);

        return ($item->delete())
          ? ["message" => "success"]
          : ["message" => "error"];
    }
}
