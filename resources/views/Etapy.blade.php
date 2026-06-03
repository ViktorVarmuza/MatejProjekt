@extends('template.main')

@section('content')

@php
    $stages = [
        ['number' => 1, 'date' => '12. 6. 2026', 'start' => 'Praha', 'finish' => 'Plzeň', 'distance' => '142 km', 'type' => 'Rovinatá', 'elevation' => '850 m'],
        ['number' => 2, 'date' => '13. 6. 2026', 'start' => 'Plzeň', 'finish' => 'Karlovy Vary', 'distance' => '168 km', 'type' => 'Kopcovitá', 'elevation' => '1850 m'],
        ['number' => 3, 'date' => '14. 6. 2026', 'start' => 'Karlovy Vary', 'finish' => 'Liberec', 'distance' => '195 km', 'type' => 'Horská', 'elevation' => '2600 m'],
    ];
@endphp

<div class="w-full max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-10 text-center">
        Etapy závodu
    </h1>

    <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">

        @foreach($stages as $stage)

            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 p-6">

                <div class="flex justify-between items-center mb-5">
                    <h2 class="text-xl font-bold">
                        Etapa {{ $stage['number'] }}
                    </h2>

                    <span class="bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full">
                        {{ $stage['type'] }}
                    </span>
                </div>

                <div class="space-y-2 text-sm text-gray-700">
                    <p><b>Datum:</b> {{ $stage['date'] }}</p>
                    <p><b>Start:</b> {{ $stage['start'] }}</p>
                    <p><b>Cíl:</b> {{ $stage['finish'] }}</p>
                    <p><b>Délka:</b> {{ $stage['distance'] }}</p>
                    <p><b>Převýšení:</b> {{ $stage['elevation'] }}</p>
                </div>

            </div>

        @endforeach

    </div>

    <div class="mt-10 text-center">
        <a href="{{ url()->previous() }}">
            <button class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition duration-300">
                Zpět
            </button>
        </a>
    </div>

</div>

@endsection