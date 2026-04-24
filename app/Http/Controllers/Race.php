<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaceModel;

class Race extends Controller
{   

    protected $raceModel;
    protected $perPage;
    public function  __construct()
    {
        $this->raceModel = new RaceModel();
        $this->perPage = config('pagination.per_page');
    }


    public function show()
    {
        $data = $this->raceModel->pagination($this->perPage);
        
        return view('home', compact('data'));
    }

<<<<<<< HEAD


=======
    
>>>>>>> fc22ba0af7731ab4e9b472a8248de095511b2492
}
