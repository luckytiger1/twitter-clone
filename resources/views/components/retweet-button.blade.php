@if($tweet->isRetweetedBy(current_user()))

    <form method="POST"
          action="/tweets/{{ $tweet->id }}/retweet"
    >
        @csrf
        @method('DELETE')
        <button type="submit"
                class="flex row"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="{{ $tweet->isRetweetedBy(current_user()) ? "#EB5757":"#4F4F4F" }}" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            <span>{{ $tweet->retweets()->count() }}</span>
        </button>
    </form>
@else

    <form method="POST"
          action="/tweets/{{ $tweet->id }}/retweet"
    >
        @csrf
        <button type="submit"
                class="flex row"
        >

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="{{ $tweet->isRetweetedBy(current_user()) ? "#EB5757":"#4F4F4F" }}" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            <span>{{ $tweet->retweets()->count() }}</span>

        </button>
    </form>
@endif
