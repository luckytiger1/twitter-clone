<x-app>
    <header class="mb-6 relative">

        <div class="relative">
            <img src="/images/default-bg.jpg" alt="bg" class="mb-2 rounded-lg">

            <img class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
                 src="{{ $user->avatar }}"
                 style="left: 50%"
                 width="150"
                 alt="avatar">
        </div>

        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="font-bold text-2xl ">
                    {{ $user->name }}
                </h2>
                <p class="text-sm">Joined {{$user->created_at ? $user->created_at->diffForHumans() : null }}</p>
            </div>

            <div class="flex">
                @can('edit', $user)
                    <a href="{{ $user->path('edit') }}"
                       class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-3">Edit
                        Profile</a>
                @endcan
                <x-follow-button :user="$user"></x-follow-button>
            </div>
        </div>

        <p class="text-sm">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad amet dolores ducimus error et ex
            excepturi facilis, harum in iusto laudantium minus necessitatibus, nihil nisi quas sint veritatis. Est,
            ipsam?</p>

    </header>

    @include('_timeline', [
    'tweets' => $tweets
])
</x-app>
