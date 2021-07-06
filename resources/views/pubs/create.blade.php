@extends('layouts.app')

@section('content')
    <div class="m-auto w-4/8 py-24">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">
                Create Publication
            </h1>
        </div>
    </div>

    <div class="flex justify-center pt-20">
        <form action="/pubs" method="POST">
            @csrf
            <div class="block">
                <textarea id="w3review" rows="4" cols="50" type="textarea" class="block shadow-5xl mb-10 p-2 w-80 italic
                placeholder-gray-400"
                name="pub"
                placeholder="What are you thinking?"></textarea>

                <button class="bg-gray-500 block shadow-5xl mb-10 p-2 w-80 uppercase bold">Submit</button>
            </div>
        </form>
    </div>
@endsection