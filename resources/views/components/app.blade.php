<x-master>
    <section class="px-8">
        <main class="container mx-auto">
            <div class="lg:flex lg:justify-between">
                @if(auth()->check())
                    <div class="lg:w-32">
                        @include('_sidebar-links')
                    </div>
                @endif

                <div class="lg:flex-1 lg:mx-10" style="max-width: 700px">

                    {{ $slot }}

                </div>
                @if(auth()->check())
                    <div class="column">
                        <div class="lg:w-full mb-4">
                            @include('_friends-list')
                        </div>
                        <div class="lg:w-full">
                            @include('_followers-list')
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </section>
</x-master>
