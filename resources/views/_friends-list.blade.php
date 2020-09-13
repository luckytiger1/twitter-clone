<div class="bg-blue-100 rounded-lg p-4">

    <h3 class="font-bold text-xl mb-4">Following</h3>

    <ul>
        @foreach(auth()->user()->follows as $user)
            <li class="mb-4">
                <a class="flex items-center" href="{{ route('profile', $user->name) }}">
                    <img class="rounded-full mr-2 flex-shrink-0"
                         width="40"
                         height="40"
                         src="{{ $user->avatar }}"
                         alt="avatar">
                    {{ $user->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
