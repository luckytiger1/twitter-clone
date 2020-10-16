@if($tweet->isSavedBy(current_user()))

    <form method="POST"
          action="/tweets/{{ $tweet->id }}/save"
    >
        @csrf
        @method('DELETE')
        <button type="submit"
                class="flex row"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="{{ $tweet->isSavedBy(current_user()) ? "#EB5757":"#4F4F4F" }}" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
            </svg>
            <span>{{ $tweet->saves()->count() }}</span>
        </button>
    </form>
@else

    <form method="POST"
          action="/tweets/{{ $tweet->id }}/save"
    >
        @csrf
        <button type="submit"
                class="flex row"
        >

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="{{ $tweet->isSavedBy(current_user()) ? "#EB5757":"#4F4F4F" }}" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
            </svg>
            <span>{{ $tweet->saves()->count() }}</span>

        </button>
    </form>
@endif
