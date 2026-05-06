<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaceModel;

class RaceDetail extends Controller
{

    public function show($id)
    {
        $data = RaceModel::where('race.id', $id)
            ->join('race_year', 'race.id', '=', 'race_year.id_race')
            ->get();
            

        return view('RaceDetail', compact('data'));
    }
}
