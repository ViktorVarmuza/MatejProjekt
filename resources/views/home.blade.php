@extends('template.main')


@section('content')

<div class="p-10">

    <h1 class="text-3xl font-bold mb-8 text-center">Závody</h1>



    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach($data as $race)

        <div class="bg-white shadow rounded-lg p-5">

            <h2 class="text-xl font-semibold mb-4">

                {{ $race->default_name }}

            </h2>



            <a href="{{ route('race', $race->id) }}">

                <button class="bg-blue-500 text-white px-4 py-2 rounded">

                    Detail

                </button>

            </a>



        </div>

        @endforeach



    </div>



    <!-- stránkování -->

    <div class="mt-8 flex justify-center">

        {{ $data->links() }}

    </div>
    @endsection