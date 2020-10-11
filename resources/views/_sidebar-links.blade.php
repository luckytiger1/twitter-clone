<ul>
    <li><a href="{{ route('home') }}" class="font-bold text-lg mb-4 block">Home</a></li>
    <li><a href="{{ route('explore') }}" class="font-bold text-lg mb-4 block">Explore</a></li>
    <li><a href="{{ route('bookmarks') }}" class="font-bold text-lg mb-4 block">Bookmarks</a></li>
    <li><a href="{{ route('profile', auth()->user()) }}" class="font-bold text-lg mb-4 block">Profile</a></li>
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
