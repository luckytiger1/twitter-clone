<ul>
    <li><a href="{{ route('home') }}" class="font-bold text-lg mb-4 block">Home</a></li>
    <li><a href="/explore" class="font-bold text-lg mb-4 block">Explore</a></li>
    <li><a href="" class="font-bold text-lg mb-4 block">Notifications</a></li>
    <li><a href="" class="font-bold text-lg mb-4 block">Messages</a></li>
    <li><a href="" class="font-bold text-lg mb-4 block">Bookmark</a></li>
    <li><a href="" class="font-bold text-lg mb-4 block">Lists</a></li>
    <li><a href="{{ route('profile', auth()->user()) }}" class="font-bold text-lg mb-4 block">Profile</a></li>
    <li><a href="" class="font-bold text-lg mb-4 block">More</a></li>
    <li>
        <a class="font-bold text-lg mb-4 block" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
</ul>
