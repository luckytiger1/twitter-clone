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
        <x-retweet-button :tweet="$tweet"/>
        <x-like-button :tweet="$tweet"/>
        <x-bookmark-button :tweet="$tweet"/>
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
    <x-comments :tweet="$tweet"/>
    <div>

    </div>
</div>

