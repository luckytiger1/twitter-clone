<div class="bg-blue-100 rounded-lg p-4">

    <h3 class="font-bold text-xl mb-4">Followers</h3>

    <ul>
        @forelse(current_user()->followers as $user)
            <li class="mb-4">
                <a class="flex items-center" href="{{ route('profile', $user->username) }}">
                    <img class="rounded-full mr-2 flex-shrink-0"
                         width="40"
                         height="40"
                         src="{{ $user->avatar }}"
                         alt="avatar">
                    {{ $user->name }}
                </a>
            </li>
        @empty
            <p>No followers yet!</p>
        @endforelse
    </ul>
</div>
