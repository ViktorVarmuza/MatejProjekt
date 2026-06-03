@extends('template.main')

@section('content')

<div class="w-full max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-10 text-center">
        {{ $data[0]->default_name }} - Detaily závodu
    </h1>

    <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">

        @foreach($data as $race)

        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 w-full">

            <div class="bg-gray-50 flex justify-center items-center h-40">

                <img
                    src="{{ $race->logo
                     ? asset('logos/' . $race->logo)
                    : asset('vtipy/vtip' . random_int(1, 14) . '.png') }}"
                    class="max-h-24 object-contain">

            </div>

            <div class="p-5">

                <h2 class="text-lg font-semibold">
                    {{ $race->real_name }} ({{ $race->year }})
                </h2>

                <p class="text-sm  mt-1">
                    Kategorie:
                    {{ $race->uci_tour_type ?? 'Neznámá kategorie' }}
                </p>

                <p class="text-sm mt-2 flex items-center gap-2">
                    <span class="fi fi-{{ strtolower($race->country) }}"></span>
                    {{ $race->country_name }}
                </p>

                <p class="text-sm  mt-1">
                    Etapy: {{ $race->stages_count ?? 'Neznámý počet' }}
                </p>


                <p class="text-sm mt-2">
                    📅
                    @if(\Carbon\Carbon::parse($race->start_date)->isSameDay($race->end_date))
                    {{ \Carbon\Carbon::parse($race->start_date)->format('d. m. Y') }}
                    @else
                    {{ \Carbon\Carbon::parse($race->start_date)->format('d. m.') }}
                    –
                    {{ \Carbon\Carbon::parse($race->end_date)->format('d. m. Y') }}
                    @endif
                </p>

                <a href="{{ route('etapy') }}?id={{ $race->YearId}}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600 transition duration-300 w-full">
                        Zobrazit Etapy 
                    </button>
                </a>


            </div>

        </div>

        @endforeach

    </div>
</div>

@endsection