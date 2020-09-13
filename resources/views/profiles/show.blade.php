@extends('layouts.app')

@section('content')
    <header class="mb-6 relative">
        <img src="/images/default-bg.jpg" alt="bg" class="mb-2 rounded-lg">

        <div class="flex justify-between items-center mb-4">
            <div>
                <h2 class="font-bold text-2xl ">
                    {{ $user->name }}
                </h2>
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div>
                <a href="" class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs">Edit Profile</a>
                <a href="" class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs">Follow me</a>
            </div>
        </div>

        <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet dolores ducimus error et ex
            excepturi
            facilis, harum in iusto laudantium minus necessitatibus, nihil nisi quas sint veritatis. Est, ipsam?</p>

        <img class="rounded-full mr-2 absolute"
             style="width: 150px; left: calc(50% - 75px); top: 40%"
             src="{{ $user->avatar }}"
             alt="avatar">


    </header>

    @include('_timeline', [
    'tweets' => $user->tweets
])
@endsection
