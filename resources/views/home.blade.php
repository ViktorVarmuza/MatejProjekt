@extends('template.main')

@section('content')

<div class="p-10 bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen">

    <h1 class="text-3xl font-bold mb-8 text-center">Závody</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($data as $race)
            <div class="bg-white/90 backdrop-blur shadow-md hover:shadow-xl transition duration-300 rounded-xl p-5 border border-gray-200">

                <h2 class="text-xl font-semibold mb-4">
                    {{ $race->default_name }}
                </h2>

                <a href="{{ route('race') }}?id={{ $race->id }}">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded">
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