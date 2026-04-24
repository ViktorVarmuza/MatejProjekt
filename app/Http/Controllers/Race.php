<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaceModel;

class Race extends Controller
{   

    protected $raceModel;
    public function  __construct()
    {
        $this->raceModel = new RaceModel();
    }


    public function show()
    {
        $data = $this->raceModel->all();
        
        return view('home', compact('data'));
    }


    
}
