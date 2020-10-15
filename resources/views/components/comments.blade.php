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
