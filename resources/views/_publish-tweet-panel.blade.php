<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="/tweets" enctype="multipart/form-data">
        @csrf
        <label>
            <textarea name="body" class="w-full" placeholder="What's new?"></textarea>
        </label>
        <hr class="my-4">

        <footer class="flex justify-between">
            <div class="flex">
                <img class="rounded-full mr-2"
                     src="{{ auth()->user()->avatar }}"
                     width="40"
                     height="40"
                     alt="avatar">
                <div>
                    <div class="flex">
                        <label for="image">Add image</label>
                        <input class="border border-gray-400 p-2 w-full"
                               type="file"
                               name="image"
                               id="image"
                               hidden
                        >
                    </div>

                    @error('image')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-2 text-white">Tweet!</button>
        </footer>

    </form>

    @error('body')
    <p class="text-red-500 text-sm mt-5">{{ $message }}</p>
    @enderror
</div>
