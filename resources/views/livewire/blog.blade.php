<section class="pb-20">
    <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl ">
        <div class="py-8 flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}">Home</a>
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 1024 1024">
                <path fill=""
                    d="M452.864 149.312a29.12 29.12 0 0 1 41.728.064L826.24 489.664a32 32 0 0 1 0 44.672L494.592 874.624a29.12 29.12 0 0 1-41.728 0a30.59 30.59 0 0 1 0-42.752L764.736 512L452.864 192a30.59 30.59 0 0 1 0-42.688m-256 0a29.12 29.12 0 0 1 41.728.064L570.24 489.664a32 32 0 0 1 0 44.672L238.592 874.624a29.12 29.12 0 0 1-41.728 0a30.59 30.59 0 0 1 0-42.752L508.736 512L196.864 192a30.59 30.59 0 0 1 0-42.688" />
            </svg>
            <span>Blogs</span>
        </div>
        <div class="grid grid-cols-12">
            <div class="col-span-12 md:col-span-10 pr-4">
                <div>
                    <img  height="200" class="max-h-[300px] mx-auto text-center"
                        src="{{ photoFirst($default_blog?->photo) }}" />
                    {{-- <span class="block mt-4 mb-3 text-xs font-medium text-secondary">Details</span> --}}
                    <h3 class="text-2xl font-medium mb-5">
                            {{ $default_blog?->title }}

                    </h3>
                    <p class="text-secondary mb-5">
                       {!! $default_blog?->description !!}
                    </p>
                </div>
                @if($default_blog)
                    <div class="mt-2 mb-9 border-t border-b py-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 16 16">
                            <path fill="#888"
                                d="M6.848 2.47a1 1 0 0 1-.318 1.378A7.3 7.3 0 0 0 3.75 7.01A3 3 0 1 1 1 10v-.027a4 4 0 0 1 .01-.232c.009-.15.027-.36.062-.618c.07-.513.207-1.22.484-2.014c.552-1.59 1.67-3.555 3.914-4.957a1 1 0 0 1 1.378.318m7 0a1 1 0 0 1-.318 1.378a7.3 7.3 0 0 0-2.78 3.162A3 3 0 1 1 8 10v-.027a4 4 0 0 1 .01-.232c.009-.15.027-.36.062-.618c.07-.513.207-1.22.484-2.014c.552-1.59 1.67-3.555 3.914-4.957a1 1 0 0 1 1.378.318" />
                        </svg>
                        <blockquote class="mb-5 text-sm">
                        {!! $default_blog?->quote !!}
                        </blockquote>
                        <h4 class="font-medium">
                            {{ $default_blog?->author_info?->name }}
                        </h4>
                        <h6 class="text-sm text-secondary">
                            {{ $default_blog?->author_info?->designation ?: 'Business Owner' }}
                        </h6>
                    </div>
                @endif
                @if ($relatedBlogs->count() > 0)
                    <div>
                        <div class="flex items-center justify-between mt-2 mb-10">
                            <h3 class="text-lg font-semibold uppercase">
                                Related Articles
                            </h3>
                            <div class="flex gap-1">
                                <button wire:click="previousBlog"
                                        class="w-9 h-9 rounded-full border bg-white flex items-center justify-center {{ $currentIndex == 0 ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer hover:bg-gray-100' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10.5" height="24" viewBox="0 0 7 16">
                                        <path fill="#888" d="M5.5 13a.47.47 0 0 1-.35-.15l-4.5-4.5c-.2-.2-.2-.51 0-.71l4.5-4.49c.2-.2.51-.2.71 0s.2.51 0 .71L1.71 8l4.15 4.15c.2.2.2.51 0 .71c-.1.1-.23.15-.35.15Z" />
                                    </svg>
                                </button>
                                <button wire:click="nextBlog"
                                        class="w-9 h-9 rounded-full border bg-white flex items-center justify-center {{ $currentIndex >= count($relatedBlogs) - 1 ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer hover:bg-gray-100' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10.5" height="24" viewBox="0 0 7 16">
                                        <path fill="#888" d="M1.5 13a.47.47 0 0 1-.35-.15c-.2-.2-.2-.51 0-.71L5.3 7.99L1.15 3.85c-.2-.2-.2-.51 0-.71s.51-.2.71 0l4.49 4.51c.2.2.2.51 0 .71l-4.5 4.49c-.1.1-.23.15-.35.15" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        @if(isset($relatedBlogs[$currentIndex]))

                            <div class="grid grid-cols-12">
                                <div class="col-span-12 md:col-span-8 grid grid-cols-12">
                                    <a href="{{ route('blogs', $relatedBlogs[$currentIndex]->slug) }}" class="relative group col-span-12 md:col-span-5">
                                        <img class="w-full h-[250px] object-cover transition-opacity group-hover:opacity-90"
                                        src="{{ photoFirst($relatedBlogs[$currentIndex]->photo) }}" />
                                        <!-- Centered blog icon overlay -->
                                        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white/90 p-3 rounded-full shadow-sm opacity-0 group-hover:opacity-100 transition-opacity">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M19 5v14H5V5zm0-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2m-5 14H7v-2h7zm3-4H7v-2h10zm0-4H7V7h10z"/>
                                            </svg>
                                        </div>
                                    </a>
                                    <div class="col-span-12 md:col-span-7 pl-7 border hover:shadow-sm transition-shadow">
                                        <!-- Rest of the content remains the same -->
                                        <div class="flex items-center gap-2 mt-5">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10s10-4.5 10-10S17.5 2 12 2m0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8s8 3.59 8 8m.5-13H11v6l5.2 3.2l.8-1.3l-4.5-2.7z"/>
                                            </svg>
                                            <h6 class="mb-2 text-xs font-medium uppercase text-primary">
                                                {{ $relatedBlogs[$currentIndex]->cat_info->title ?? 'Uncategorized' }}
                                            </h6>
                                        </div>
                                        <a href="{{ route('blogs', $relatedBlogs[$currentIndex]->slug) }}" class="block group">
                                            <h3 class="text-lg font-semibold mb-2 group-hover:text-primary transition-colors">
                                                {{ $relatedBlogs[$currentIndex]->title }}
                                            </h3>
                                        </a>
                                        <p class="mb-5 text-secondary">
                                            {{ Str::words(strip_tags($relatedBlogs[$currentIndex]->description), 20) }}
                                        </p>
                                        <div class="flex items-center gap-3 pb-4">
                                            <img class="w-10 h-10 rounded-full border-2 border-primary/10"
                                                src="{{ $relatedBlogs[$currentIndex]->author_info->photo ?? asset('images/default/profile.jpg') }}" />
                                            <div>
                                                <h4 class="text-sm font-medium">{{ $relatedBlogs[$currentIndex]->author_info->name ?? 'Anonymous' }}</h4>
                                                <span class="text-xs text-secondary">Author</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            @if ($popularBlogs->count() > 0)
                <div class="col-span-12 md:col-span-2 pl-4">

                    {{-- <div class="mb-12">
                        <div class="flex items-center pb-6 gap-2">
                            <span class="inline-block bg-primary w-6 h-[2px]"></span>
                            <h3 class="text-sm font-semibold uppercase">CATEGORIES</h3>
                        </div>
                        <div class="flex flex-col gap-1">
                            @foreach ($categories as $category)
                                <div class="flex items-center gap-2">
                                    <input id="new-arrivals" type="checkbox" />
                                    <label for="new-arrivals" class="text-secondary">{{$category->title}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div> --}}


                        <div class="mb-12">
                            <div class="flex items-center pb-6 gap-2">
                                <span class="inline-block bg-primary w-6 h-[2px]"></span>
                                <h3 class="text-sm font-semibold uppercase">
                                    Popular Articles
                                </h3>
                            </div>
                            <div class="flex flex-col gap-1">
                                @foreach ($popularBlogs as $blog)
                                    <div class="flex gap-2 mb-5">
                                        <a href="{{ route('blogs', $blog->slug) }}">
                                            <img src="{{ photoFirst($blog->photo) }}"
                                            class="w-24 h-24 object-cover" />
                                        </a>
                                        <div>
                                            <h3 class="text-xs font-semibold text-secondary">
                                                {{ $blog->cat_info->title ?? 'Uncategorized' }}
                                            </h3>
                                            <h6 class="text-sm font-medium mt-1">
                                               <a href="{{ route('blogs', $blog->slug) }}">{{ $blog->title }}</a>
                                            </h6>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                </div>
            @endif
        </div>
    </div>
</section>
