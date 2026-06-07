@extends('template.main')

@section('content')

<div class="w-full max-w-6xl mx-auto px-6 py-10">

    {{-- NOVÝ FUNKČNÍ HEADER --}}
    <div class="flex items-center justify-between mb-10 bg-gray-100 px-6 py-4 rounded-xl shadow-sm border border-gray-200">

        <a href="{{ url()->previous() }}"
            class="text-gray-600 hover:text-black transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            Zpět
        </a>

        <h1 class="text-3xl font-bold text-center flex-1">
            Přehled etap - {{ $data[0]->default_name ?? 'Detaily závodu' }}
        </h1>



     
    </div>

    {{-- SEZNAM ETAP --}}
    @foreach($data as $stage)

    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden mb-8">

        <div class="grid grid-cols-1 md:grid-cols-2 md:min-h-[360px]">

            <div class="p-8 flex flex-col justify-center">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">
                        Etapa {{ $stage->number }}
                    </h2>

                    <span class="bg-blue-100 text-blue-700 text-sm font-semibold px-4 py-1 rounded-full">
                        {{ $stage->parcour_type_name }}
                    </span>
                </div>

                <div class="grid grid-cols-1 gap-3 text-gray-700">

                    <p>
                        <b>Datum:</b>
                        {{ \Carbon\Carbon::parse($stage->date)->format('d. m. Y') }}
                    </p>

                    <p>
                        <b>Délka:</b>
                        {{ $stage->distance }} km
                    </p>

                    <p>
                        <b>Start:</b>
                        {{ $stage->departure }}
                    </p>

                    <p>
                        <b>Cíl:</b>
                        {{ $stage->arrival }}
                    </p>

                    <p>
                        <b>Typ etapy:</b>
                        {{ $stage->parcour_type_name }}
                    </p>

                </div>

            </div>

            <div class="bg-gray-100 flex items-center justify-center overflow-hidden h-full p-4">
                <img
                    src="{{ $stage->profile
                        ? asset('stages/profiles/' . $stage->profile)
                        : asset('vtipy/vtip' . random_int(1, 14) . '.png') }}"
                    class="w-full m-3">
            </div>

        </div>

    </div>

    @endforeach

</div>

@endsection