@extends('template.main')

@section('content')

<div class="p-10 bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen">

<h1 class="text-4xl font-semibold mb-12 text-center text-gray-800">
    Závody
</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($data as $race)
            <div class="bg-white/90 backdrop-blur shadow-md hover:shadow-xl transition duration-300 rounded-xl p-5 border border-gray-200">

                <h2 class="text-xl font-semibold mb-4 text-gray-800">
                    {{ $race->default_name }}
                </h2>

                <a href="{{ route('race', $race->id) }}">
                    <button class="bg-blue-600 hover:bg-blue-700 transition duration-200 text-white px-4 py-2 rounded-lg shadow-sm">
                        Detail 
                    </button>
                </a>

            </div>
        @endforeach

    </div>

    {{-- Pagination center --}}
    <div class="mt-12 flex justify-center">
        {{ $data->onEachSide(1)->links() }}
    </div>

</div>

@endsection