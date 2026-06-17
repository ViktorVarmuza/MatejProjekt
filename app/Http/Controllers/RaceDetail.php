<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CountryServices;
use App\Models\RaceYear;
use App\Models\uci_tour_type;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class RaceDetail extends Controller
{

    public function show($id,   CountryServices $countryServices) // CountryServices vytvori tridu
    {   


        $data = RaceYear::where('id_race', $id)
            ->select('race.*', 'race_year.*',  'uci_tour_type.name as uci_tour_type', 'race_year.id as YearId', 'race.id as raceId') // co se selectne z dotazu
            ->join('race', 'race.id', '=', 'race_year.id_race')
            ->join('uci_tour_type', 'race_year.uci_tour', '=', 'uci_tour_type.id')
            ->withCount('stages')
            ->get();

            

        $uciTourTypes = uci_tour_type::all();

        $modalData = [
            "countries" => $countryServices->getAllCountries(), // všechny země uloží do countries
            "uciTourTypes" => $uciTourTypes // všechny ucitypes do uciTourTypes
        ];  
        //modal data

        foreach ($data as $race) { // prochází každý závod v datech
            $country = $countryServices->getCountry($race->country); // získá informace o zemi podle kódu země
            $race->country_name = $country['name']; // nastaví název země do vlastnosti country_name závodu
        }

        // nastavuju countryName do dat


        return view('RaceDetail', compact('data', 'modalData')); // formatuje data
    }

    public function destroy($id)
    {   

        //vymazani dat
        $race = RaceYear::findOrFail($id);
        $race->delete();
        
        return redirect()->back()->with('success', 'Ročník závodu byl úspěšně smazán.');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'real_name'  => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'year'       => 'required|integer',
            'sex'        => 'required|in:M,W',
            'uci_tour'   => 'required|integer',
            'country'    => 'required|string|size:2',
            'logo'       => 'nullable|image|mimes:jpeg,png,jpg,svg',
            'id_race' => 'required|integer|',
        ]);

        // validace dat




        $filename = null;

        if ($request->hasFile('logo')) {
            $filename = "logo-" . Str::uuid() . "." . $request->file('logo')->getClientOriginalExtension();

            // Natvrdo přesune soubor do tvé složky public/logo/
            $request->file('logo')->move(public_path('logos'), $filename);
        }

        // nahrani loga do slozky public/logos a vygenerovani unikatniho nazvu pro logo



        // 3. ULOŽENÍ DO DATABÁZE
        $edition = new RaceYear();
        $edition->id_race = $validated['id_race'];
        $edition->real_name = $validated['real_name'];
        $edition->start_date = $validated['start_date'];
        $edition->end_date = $validated['end_date'];
        $edition->year = $validated['year'];
        $edition->sex = $validated['sex'];
        $edition->uci_tour = $validated['uci_tour'];
        $edition->country = $validated['country'];
        $edition->logo = $filename;
        $edition->save();;
        // Přesměrování zpět s úspěšnou hláškou
        return redirect()->back()->with('success', 'Ročník závodu byl úspěšně vytvořen.');
    }

    public function edit(Request $request)
    {
        // 1. VALIDACE (pohlídáme správnost dat a bezpečnost)
        $validated = $request->validate([
            'real_name'  => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'year'       => 'required|integer',
            'sex'        => 'required|in:M,W',
            'uci_tour'   => 'required|integer',
            'country'    => 'required|string|size:2',
            'logo'       => 'nullable|image|mimes:jpeg,png,jpg,svg',
            'id' => 'required|integer'
        ]);

        $id = $validated['id'];

        $edition = RaceYear::findOrFail($id);


        if ($request->hasFile('logo')) {

            $oldFilePath = public_path('logos/' . $edition->logo);

            
            if ($edition->logo && file_exists($oldFilePath)) {
                @unlink($oldFilePath); 
            }

         
            $filename = "logo-" . Str::uuid() . "." . $request->file('logo')->getClientOriginalExtension();


            $request->file('logo')->move(public_path('logos'), $filename);

           
            $edition->logo = $filename;
        }

     
        $edition->real_name = $validated['real_name'];
        $edition->start_date = $validated['start_date'];
        $edition->end_date = $validated['end_date'];
        $edition->year = $validated['year'];
        $edition->sex = $validated['sex'];
        $edition->uci_tour = $validated['uci_tour']; 
        $edition->country = $validated['country'];

        
        $edition->save();

    
        return redirect()->back()->with('success', 'Ročník byl úspěšně upraven.');
    }
}
