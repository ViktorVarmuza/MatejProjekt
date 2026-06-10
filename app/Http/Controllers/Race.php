<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaceModel;

class Race extends Controller
{   


    protected $perPage; // počet záznamů na stránku pro stránkování

    public function  __construct() // konstruktor 
    {

        $this->perPage = config('pagination.per_page');
    }


    public function show() // vypisuje všechny závody a zobrazuje je na stránce home.blade.php
    {
        $data = RaceModel::paginate($this->perPage);

        
        
        return view('home', compact('data'));
    }

    // compact $data = ['data' => $data]
}
