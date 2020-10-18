@foreach($tweet->comments as $comment)
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
            </div>
        </div>
    </div>
@endforeach
