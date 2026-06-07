@extends('template.main')

@section('content')

@if(session('success'))
@include('template.alerts.succes')
@elseIf(session('error'))
@include('template.alerts.error')
@endif


<div class="w-full max-w-7xl mx-auto px-6 py-10">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-10 bg-gray-100 px-6 py-4 rounded-xl shadow-sm border border-gray-200">

        <a href="{{ route('home') }}"
            class="text-gray-600 hover:text-black transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            Zpět
        </a>

        <h1 class="text-3xl font-bold text-center flex-1">
            {{ $data[0]->default_name }} - Detaily závodu
        </h1>



        <button
            data-modal-target="add-modal"
            data-modal-toggle="add-modal"
            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition flex items-center gap-2">

            <i class="fa-solid fa-plus"></i>
            Přidat
        </button>


        @include('template.modals.add', ['route' => 'race.create','id' => $data[0]->raceId, 'data' => $modalData, 'raceName' => $data[0]->default_name])
    </div>

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

                <p class="text-sm mt-1">
                    <i class="fa-solid fa-layer-group"></i>
                    Kategorie: {{ $race->uci_tour_type ?? 'Neznámá kategorie' }}
                </p>

                <p class="text-sm mt-2 flex items-center gap-2">
                    <i class="fa-solid fa-flag"></i>
                    <span class="fi fi-{{ strtolower($race->country) }}"></span>
                    {{ $race->country_name }}
                </p>

                <p class="text-sm mt-1">
                    <i class="fa-solid fa-route"></i>
                    Etapy: {{ $race->stages_count ?? 'Neznámý počet' }}
                </p>

                <p class="text-sm mt-2">
                    <i class="fa-solid fa-calendar"></i>

                    @if(\Carbon\Carbon::parse($race->start_date)->isSameDay($race->end_date))
                    {{ \Carbon\Carbon::parse($race->start_date)->format('d. m. Y') }}
                    @else
                    {{ \Carbon\Carbon::parse($race->start_date)->format('d. m.') }}
                    –
                    {{ \Carbon\Carbon::parse($race->end_date)->format('d. m. Y') }}
                    @endif
                </p>

                <div class="flex gap-2 mt-4">

                    <a href="{{ route('etapy', ['id' => $race->YearId]) }}"
                        class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300 w-full text-center flex items-center justify-center gap-2">

                        <i class="fa-solid fa-list"></i>
                        Etapy
                    </a>

                    {{-- EDIT --}}
                    <button type="button"
                        data-modal-target="edit-modal-{{ $race->YearId }}"
                        data-modal-toggle="edit-modal-{{ $race->YearId }}"
                        class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition flex items-center justify-center">
                        <i class="fa-solid fa-pen"></i>
                    </button>

                    {{-- DELETE --}}
                    <button
                        data-modal-target="delete-modal-{{ $race->YearId }}"
                        data-modal-toggle="delete-modal-{{ $race->YearId }}"
                        class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition flex items-center justify-center">

                        <i class="fa-solid fa-trash"></i>
                    </button>

                </div>

                @include('template.modals.delete', [
                'id' => $race->YearId,
                'route' => 'race.delete',
                ])

                @include('template.modals.edit', [
                'id' => $race->YearId,
                'data' => $modalData,
                'race' => $race,
                'route' => 'race.edit',
                'raceName' => $data[0]->default_name])

            </div>
        </div>

        @endforeach

    </div>
</div>

@endsection