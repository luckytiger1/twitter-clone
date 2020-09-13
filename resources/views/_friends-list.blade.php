<h3 class="font-bold text-xl mb-4">Friends</h3>

<ul>
    @foreach(range(1,8) as $index)
        <li class="mb-4">
            <div class="flex items-center">
                <img class="rounded-full mr-2"
                     src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/84/847926e30614722e6cbc417a7180725cc1e975c5.jpg"
                     alt="avatar">
                John Doe
            </div>
        </li>
    @endforeach
</ul>
