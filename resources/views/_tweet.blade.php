<div
    class="border border-gray-300 rounded-lg bg-white flex row flex-col p-4 {{ $loop->last ? '' : 'border-b border-b-gray-400' }} mb-5">
    <div class="mr-2 flex-shrink-0 flex row">
        <div>
            <a href="{{ route('profile', $tweet->user->name) }}">
                <img class="rounded-full mr-2"
                     width="50"
                     height="50"
                     src="{{ $tweet->user->avatar }}"
                     alt="avatar">
            </a>
        </div>
        <div>
            <h5 class="font-bold text-lg">
                <a href="{{ route('profile', $tweet->user->name) }}">
                    {{ $tweet->user->name }}
                </a>
            </h5>
            <span class="text-xs text-gray-700">
            {{ $tweet->created_at->diffForHumans() }}
        </span>
        </div>
    </div>
    <div class="mb-3">
        <p class="text-sm my-5 text-lg">
            {{ $tweet->body }}
        </p>
        <img src="{{ $tweet->image }}" alt="" class="border rounded-lg">
    </div>
    <div class="flex row justify-between p-4 border border-top border-bottom border-l-0 border-r-0 border-gray-300">
        <div class="flex row">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#4F4F4F" class="h-6 w-6">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
            </svg>
            <span>{{ count($tweet->comments) }}</span>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#4F4F4F" class="h-6 w-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        @if($tweet->isLikedBy(current_user()))

            <form method="POST"
                  action="/tweets/{{ $tweet->id }}/like"
            >
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="flex row"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="{{ $tweet->isLikedBy(current_user()) ? "#EB5757":"#4F4F4F" }}" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span>{{ $tweet->likes()->count() }}</span>
                </button>
            </form>
        @else
            <form method="POST"
                  action="/tweets/{{ $tweet->id }}/like"
            >
                @csrf
                <button type="submit"
                        class="flex row"
                >

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke="{{ $tweet->isLikedBy(current_user()) ? "#EB5757":"#4F4F4F" }}" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    <span>{{ $tweet->likes()->count() }}</span>

                </button>
            </form>
        @endif

        @if($tweet->isSavedBy(current_user()))

            <form method="POST"
                  action="/tweets/{{ $tweet->id }}/like"
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
                  action="/tweets/{{ $tweet->id }}/like"
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
    </div>
    <form action="/comments" method="POST">
        @csrf
        <div class="flex row mt-3">
            <div>
                <a href="{{ route('profile', $tweet->user->name) }}">
                    <img class="rounded-full mr-2"
                         width="50"
                         height="50"
                         src="{{ current_user()->avatar }}"
                         alt="avatar">
                </a>
            </div>
            <div class="w-full">
            <textarea name="comment-body" class="w-full border border-gray-300 rounded-lg h-12"
                      placeholder="Tweet your reply"></textarea>
                @error('comment-body')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex justify-between mt-4">
            <div class="flex ml-12">

            </div>
            <input type="hidden" name="tweet_id" id="tweet_id" value="{{ $tweet->id }}">
            <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-2 text-white">Tweet!</button>
        </div>
    </form>
    @foreach($tweet->comments as $comment)
        <div class="flex row border border-gray-300 my-4 items-center">
            <img class="rounded-full mr-2"
                 width="50"
                 height="50"
                 src="{{ $comment->author->avatar}}"
                 alt="avatar">
            <p>
                {{ $comment->body }}
            </p>
        </div>
    @endforeach
    <div>

    </div>
    {{--    <x-like-buttons :tweet="$tweet"/>--}}
</div>

