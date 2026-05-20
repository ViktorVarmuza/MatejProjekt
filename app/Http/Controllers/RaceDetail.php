<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaceModel;
use App\Services\CountryServices;


class RaceDetail extends Controller
{

    public function show(Request $request,  CountryServices $countryServices)
    {
        $id = $request->query('id');

        $data = RaceModel::where('race.id', $id)
            ->select('race.*','race_year.*' ,  'uci_tour_type.name as uci_tour_type')
            ->join('race_year', 'race.id', '=', 'race_year.id_race')
            ->join('uci_tour_type', 'race_year.uci_tour', '=', 'uci_tour_type.id')
            ->get();



        foreach ($data as $race) {
            $country = $countryServices->getCountry($race->country);
            $race->country_name = $country['name'];
        }



        return view('RaceDetail', compact('data'));
    }
}
