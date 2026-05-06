@extends('template.main')

@section('content')

<div class="w-full max-w-7xl mx-auto px-6 py-10">

    <h1 class="text-3xl font-bold mb-10 text-center">
        {{ $data[0]->default_name }} - Detaily závodu
    </h1>

    <div class="grid gap-8 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">

        @foreach($data as $race)

        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 w-full">

            @if($race->logo)
            <div class="bg-gray-50 flex justify-center items-center h-40">
                <img src="{{ asset('logos/' . $race->logo) }}"
                    class="max-h-24 object-contain">
            </div>
            @endif

            <div class="p-5">

                <h2 class="text-lg font-semibold">
                    {{ $race->real_name }} ({{ $race->year }})
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    {{ $race->category ?? 'Neznámá kategorie' }}
                </p>

                <p class="text-sm mt-2">
                    🌍 {{ $race->country_name }}
                </p>

                <p class="text-sm mt-2">
                    📅
                    @if($race->date_from == $race->date_to)
                    {{ \Carbon\Carbon::parse($race->date_from)->format('d. m. Y') }}
                    @else
                    {{ \Carbon\Carbon::parse($race->date_from)->format('d. m.') }}
                    –
                    {{ \Carbon\Carbon::parse($race->date_to)->format('d. m. Y') }}
                    @endif
                </p>

                <p class="text-sm mt-2">
                    🚴 {{ $race->stages }} etap
                </p>

            </div>

        </div>

        @endforeach

    </div>
</div>

@endsection