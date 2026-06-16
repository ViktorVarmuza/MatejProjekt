<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\CountryServices;
use App\Models\RaceYear;
use App\Models\uci_tour_type;

use Illuminate\Support\Str;


class RaceDetail extends Controller
{

    public function show($id,   CountryServices $countryServices)
    {


        $data = RaceYear::where('id_race', $id)
            ->select('race.*', 'race_year.*',  'uci_tour_type.name as uci_tour_type', 'race_year.id as YearId', 'race.id as raceId')
            ->join('race', 'race.id', '=', 'race_year.id_race')
            ->join('uci_tour_type', 'race_year.uci_tour', '=', 'uci_tour_type.id')
            ->withCount('stages')
            ->get();


        $uciTourTypes = uci_tour_type::all();

        $modalData = [
            "countries" => $countryServices->getAllCountries(),
            "uciTourTypes" => $uciTourTypes
        ];

        foreach ($data as $race) {
            $country = $countryServices->getCountry($race->country);
            $race->country_name = $country['name'];
        }



        return view('RaceDetail', compact('data', 'modalData'));
    }

    public function destroy($id)
    {
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
            'description' => 'nullable|string', // Přidána validace pro TinyMCE popis
        ]);



        $filename = null;



        if ($request->hasFile('logo')) {
            $filename = "logo-" . Str::uuid() . "." . $request->file('logo')->getClientOriginalExtension();

            // Natvrdo přesune soubor do tvé složky public/logo/
            $request->file('logo')->move(public_path('logos'), $filename);
        }



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
        $edition->description = $validated['description'];
        $edition->save();;
        // Přesměrování zpět s úspěšnou hláškou
        return redirect()->back()->with('success', 'Ročník závodu byl úspěšně vytvořen.');
    }


    public function edit(Request $request)
    {
        // 1. VALIDACE (pohlídáme správnost dat a bezpečnost)
        $validated = $request->validate([
            'id'          => 'required|integer',
            'real_name'   => 'required|string|max:255',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after_or_equal:start_date',
            'year'        => 'required|integer',
            'sex'         => 'required|in:M,W',
            'uci_tour'    => 'required|integer',
            'country'     => 'required|string|size:2',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048', // doporučený limit 2MB
            'description' => 'nullable|string', // Přidána validace pro TinyMCE popis
        ]);

        $id = $validated['id'];

        // 2. NAČTENÍ MODELU
        $edition = RaceYear::findOrFail($id);

        // 3. ZPRACOVÁNÍ LOGA (pokud bylo nahráno nové)
        if ($request->hasFile('logo')) {
            $oldFilePath = public_path('logos/' . $edition->logo);

            // Smazání starého loga, pokud existuje
            if ($edition->logo && file_exists($oldFilePath)) {
                @unlink($oldFilePath);
            }

            // Vygenerování unikátního názvu souboru
            $filename = "logo-" . Str::uuid() . "." . $request->file('logo')->getClientOriginalExtension();

            // Přesun souboru do public/logos
            $request->file('logo')->move(public_path('logos'), $filename);

            // Uložení názvu do modelu
            $edition->logo = $filename;
        }

        // 4. MAPOVÁNÍ OSTATNÍCH POLÍ DO MODELU
        $edition->real_name = $validated['real_name'];
        $edition->start_date = $validated['start_date'];
        $edition->end_date = $validated['end_date'];
        $edition->year = $validated['year'];
        $edition->sex = $validated['sex'];

        // Pozor: V Blade máš uuci_tour_type_id, upravil jsem podle toho název sloupce v DB
        $edition->uci_tour = $validated['uci_tour'];
        $edition->country = $validated['country'];

        // --- TADY JE TO PŘIDANÉ DESCRIPTION Z TINYMCE ---
        $edition->description = $validated['description'];

        // 5. ULOŽENÍ DO DATABÁZE
        $edition->save();

        // 6. REDIRECT S ÚSPĚŠNOU ZPRÁVOU
        return redirect()->back()->with('success', 'Ročník byl úspěšně upraven.');
    }
}
