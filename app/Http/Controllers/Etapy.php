<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Stages;

class Etapy extends Controller
{
    public function show($id)
    {

        $data = Stages::where('id_race_year', $id)
            ->select('stage.*', 'parcour_type.name as parcour_type_name')
            ->join('parcour_type', 'stage.parcour_type', '=', 'parcour_type.id')
            ->orderBy('stage.number', 'asc') 
            ->get();


        return view('etapy', compact('data'));
    }
}
