<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaceModel;

class Race extends Controller
{   


    protected $perPage;
    public function  __construct()
    {

        $this->perPage = config('pagination.per_page');
    }


    public function show()
    {
        $data = RaceModel::paginate($this->perPage);
        
        return view('home', compact('data'));
    }


}
