@foreach($comments as $comment)
    <div class="flex row ">
        <a href="{{ route('profile', $comment->author->username) }}">
            <img class="rounded-full mr-2 object-contain"
                 width="50"
                 height="50"
                 src="{{ $comment->author->avatar}}"
                 alt="avatar">
        </a>
        <div class="flex row border border-gray-300 my-4 items-center w-full">
            <div>
                <div class="flex row mb-4">
                    <h5 class="font-bold">{{ $comment->author->name }}</h5>
                    <span class="text-xs text-gray-700 ml-3">
                {{ $comment->created_at->diffForHumans() }}
                </span>
                </div>
                <p>
                    {{ $comment->body }}
                </p>
                <x-comment-like-button :comment="$comment"/>
            </div>

        </div>

    </div>
    <form action="/replies" method="POST">
        @csrf
        <div class="flex row mt-3">
            <div>

                <img class="rounded-full mr-2"
                     width="50"
                     height="50"
                     src="{{ current_user()->avatar }}"
                     alt="avatar">

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
            <input type="hidden" name="tweet_id" id="tweet_id" value="{{ $tweet_id }}">
            <input type="hidden" name="comment_id" id="comment_id" value="{{ $comment->id }}">
            <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-2 text-white">Reply!</button>
        </div>
    </form>
    {{--    {{dd($comment->replies)}}--}}
    @include('components.comments', ['comments' => $comment->replies])
    {{--    <x-comments :tweet="{{$comment->replies}}"/>--}}

@endforeach
