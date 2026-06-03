<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Etapy extends Controller
{
    public function show(Request $request)
    {
        $id = $request->query('id');

        return view('etapy',);
    }
}
