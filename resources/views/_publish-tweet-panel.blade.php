<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="/tweets">
        @csrf
        <label>
            <textarea name="body" class="w-full" placeholder="What's new?"></textarea>
        </label>
        <hr class="my-4">

        <footer class="flex justify-between">
            <img class="rounded-full mr-2"
                 src="{{ auth()->user()->avatar }}"
                 alt="avatar">
            <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-2 text-white">Tweet!</button>
        </footer>

    </form>

    @error('body')
        <p class="text-red-500 text-sm mt-5">{{ $message }}</p>
    @enderror
</div>
