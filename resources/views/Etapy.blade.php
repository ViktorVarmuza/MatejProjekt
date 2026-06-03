@extends('template.main')

@section('content')

<div class="w-full max-w-6xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-10 text-center">
        Etapy závodu
    </h1>

    <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden">

        <div class="grid grid-cols-1 md:grid-cols-3">

            <div class="md:col-span-2 p-8">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">
                        Etapa 1
                    </h2>

                    <span class="bg-blue-100 text-blue-700 text-sm font-semibold px-4 py-1 rounded-full">
                        Kopcovitá
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">

                    <p><b>Datum:</b> 12. 6. 2026</p>
                    <p><b>Délka:</b> 158 km</p>

                    <p><b>Start:</b> Praha</p>
                    <p><b>Cíl:</b> Brno</p>

                    <p><b>Typ etapy:</b> Kopcovitá</p>
                    <p><b>Vertikální převýšení:</b> 1850 m</p>

                </div>

            </div>

            <div class="bg-gray-100 flex items-center justify-center p-6">
                <img
                    src="{{ asset('vtipy/vtip1.png') }}"
                    alt="Obrázek etapy"
                    class="w-full h-64 object-cover rounded-xl">
            </div>

        </div>

    </div>

    <div class="mt-10 text-center">
        <a href="{{ url()->previous() }}"
           class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition duration-300">
            Zpět
        </a>
    </div>

</div>

@endsection