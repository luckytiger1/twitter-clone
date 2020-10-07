<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="/tweets" enctype="multipart/form-data">
        @csrf
        <div class="flex row">
            <footer class="flex justify-between mr-3">
                <div class="flex">
                    <img class="rounded-full mr-2 h-10"
                         src="{{ auth()->user()->avatar }}"
                         width="40"
                         height="40"
                         alt="avatar"

                    >
                    <div>
                    </div>
                </div>
            </footer>

            <div class="w-full">
                <label>
                    <textarea name="body" class="w-full" placeholder="What's new?"></textarea>
                </label>
                <hr class="my-4">
            </div>
        </div>

        <div id="dvPreview">
            <img id="thumbnil" style="width:70%; margin-top:15px; margin-bottom: 15px" src="" alt=""/>
        </div>
        <div class="flex justify-between">
            <div class="flex">
                <label for="image">

                    <svg viewBox="0 0 24 24"
                         class="r-13gxpu9 r-4qtqp9 r-yyyyoo r-1q142lx r-50lct3 r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1srniue"
                         width="24" height="24" fill="rgb(29, 161, 242)">
                        <g>
                            <path
                                d="M19.75 2H4.25C3.01 2 2 3.01 2 4.25v15.5C2 20.99 3.01 22 4.25 22h15.5c1.24 0 2.25-1.01 2.25-2.25V4.25C22 3.01 20.99 2 19.75 2zM4.25 3.5h15.5c.413 0 .75.337.75.75v9.676l-3.858-3.858c-.14-.14-.33-.22-.53-.22h-.003c-.2 0-.393.08-.532.224l-4.317 4.384-1.813-1.806c-.14-.14-.33-.22-.53-.22-.193-.03-.395.08-.535.227L3.5 17.642V4.25c0-.413.337-.75.75-.75zm-.744 16.28l5.418-5.534 6.282 6.254H4.25c-.402 0-.727-.322-.744-.72zm16.244.72h-2.42l-5.007-4.987 3.792-3.85 4.385 4.384v3.703c0 .413-.337.75-.75.75z"></path>
                            <circle cx="8.868" cy="8.309" r="1.542"></circle>
                        </g>
                    </svg>
                </label>
                <input class="border border-gray-400 p-2 w-full"
                       type="file"
                       name="image"
                       id="image"
                       hidden
                >
                @error('image')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>


            <button type="submit" class="bg-blue-500 rounded-lg shadow py-2 px-2 text-white">Tweet!</button>
        </div>

        @error('body')
        <p class="text-red-500 text-sm mt-5">{{ $message }}</p>
        @enderror
    </form>

</div>
