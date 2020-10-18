@if($comment->isLikedBy(current_user()))

    <form method="POST"
          action="/comments/{{ $comment->id }}/like"
    >
        @csrf
        @method('DELETE')
        <button type="submit"
                class="flex row"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="{{ $comment->isLikedBy(current_user()) ? "#EB5757":"#4F4F4F" }}" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <span>{{ $comment->likes()->count() }}</span>
        </button>
    </form>
@else
    <form method="POST"
          action="/comments/{{ $comment->id }}/like"
    >
        @csrf
        <button type="submit"
                class="flex row"
        >

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="{{ $comment->isLikedBy(current_user()) ? "#EB5757":"#4F4F4F" }}" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
            <span>{{ $comment->likes()->count() }}</span>

        </button>
    </form>
@endif
