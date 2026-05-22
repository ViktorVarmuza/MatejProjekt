<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Etapy extends Controller
{
    public function show(Request $request)
    {
        $id = $request->query('id');

        // Zde můžete načíst data o etapách pro dané ID závodu
        // Například:
        // $stages
    }
}
