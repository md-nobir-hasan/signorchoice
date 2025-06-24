<div>
    <style>
        .bg-primary {
            background-color: #ab8e66 !important;
        }
    </style>
    <!-- Top Bar Start -->
    <section class="bg-primary py-1 md:py-3 lg:py-5">
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl  flex items-center justify-between text-white">
            <span class="">Welcome to our online store!</span>
            <div class="flex items-center gap-2">
                @if (auth()->user())
                    <a href="{{ route('user.logout') }}">
                        <button
                            class="cursor-pointer  transition-all duration-300 ease-in-out">
                            Logout
                        </button>
                    </a>
                @else
                    <a href="{{ route('user.login') }}">
                        <button
                            class="cursor-pointer  transition-all duration-300 ease-in-out">
                            Login
                        </button>
                    </a>
                    <span>or</span>
                    <a href="{{ route('user.login') }}">
                        <button
                            class="cursor-pointer transition-all duration-300 ease-in-out">
                            Register
                        </button>
                    </a>
                @endif
            </div>
        </div>
    </section>
    <!-- Top Bar End -->

    <!-- Top Header Start -->
    <section>
        <div class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl  flex items-center justify-between py-4 md:py-8 lg:py-10 ">
            <div>
                <a href="{{ route('home') }}">
                    <h2 class="font-bold text-primary text-xl md:text-2xl">{{ env('APP_NAME') }}</h2>
                </a>
            </div>
            <form action="{{ route('searching_product') }}" method="get">
                <div x-data="{ search: '', suggestions: ['Shoes', 'Shirts', 'Accessories', 'Hats', 'Bags'], filteredSuggestions: [] }" class="relative hidden md:block">
                    <input type="text" name="search_text" class="px-5 py-2 w-96 border rounded-full outline-none"
                        placeholder="Search here" x-model="search"
                        @input="filteredSuggestions = suggestions.filter(item => item.toLowerCase().includes(search.toLowerCase()))" />
                    <div x-show="search.length > 0 && filteredSuggestions.length > 0" x-transition
                        class="absolute left-0 mt-1 bg-white text-black shadow-lg rounded w-96">
                        <ul>
                            <template x-for="item in filteredSuggestions" :key="item">
                                <li class="hover:bg-gray-200 cursor-pointer p-2"
                                    @click="search = item; filteredSuggestions = []" x-text="item"></li>
                            </template>
                        </ul>
                    </div>
                    <div class="absolute right-0 top-0 flex items-center h-full">
                        <div @mouseenter="open = true" @mouseleave="open = false" class="px-5 py-2 border"
                            x-data="{ open: false, selectedCategory: 'Accessories' }">
                            <!-- Title that dynamically updates -->
                            <h3 class="selected-category" x-text="selectedCategory"></h3>

                            <!-- Main Dropdown Menu -->
                            <div x-show="open" x-transition style="display: none;"
                                class="absolute top-full left-0 mt-2 bg-white text-black shadow-lg rounded w-56 z-50">
                                <ul class="p-0">
                                    <input type="text" name="cat_id" x-model='selectedCategory' hidden>
                                    <!-- Category  -->
                                    @foreach ($menus as $menu)
                                        @if (count($menu->products) > 0)
                                            <li x-data="{ subOpen: false }" class="relative" @mouseenter="subOpen = true"
                                                @mouseleave="subOpen = false">

                                                {{-- checking child category contain product or not  --}}
                                                @php
                                                    $has_child = 0;
                                                @endphp
                                                @foreach ($menu->child_cat as $menu2)
                                                    @if (count($menu2->sub_products) > 0)
                                                        @php
                                                            ++$has_child;
                                                        @endphp
                                                    @endif
                                                @endforeach

                                                <div class="w-full text-left hover:bg-gray-200 cursor-pointer border-b p-4 flex justify-between"
                                                    @click="selectedCategory = '{{ $menu->slug }}'">
                                                    {{ $menu->title }}
                                                    {{-- @if (count($menu->child_cat) > 0 && $has_child > 0)
                                                        <span>&#9656;</span>
                                                    @endif --}}
                                                </div>
                                                <!-- Submenu -->
                                                {{-- @if (count($menu->child_cat) > 0 && $has_child > 0)
                                                    <ul x-show="subOpen" x-transition
                                                        class="absolute left-full top-0 mt-0 bg-gray-100 shadow-lg w-56">
                                                        @foreach ($menu->child_cat as $menu2)
                                                            @if (count($menu2->sub_products) > 0)
                                                                <li class="hover:bg-gray-200 cursor-pointer border-b p-4"
                                                                    @click="selectedCategory = '{{ $menu2->slug }}'">
                                                                    <span>{{ $menu2->title }}</span>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                @endif --}}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Search Button -->

                        <div>
                            <a href="{{ route('shop') }}">
                                <button
                                    class="w-14 h-full py-2 rounded-r-full bg-primary text-secondary flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <g fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2">
                                            <circle cx="11" cy="11" r="8" />
                                            <path d="m21 21l-4.3-4.3" />
                                        </g>
                                    </svg>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            <div class="flex items-center justify-between gap-4">
                <div class="relative">
                    <a href="{{ route('vcart') }}">
                        <span
                            class="bg-primary absolute -top-3 -right-2 p-[2px] w-[20px] h-[20px] text-sm flex items-center justify-center text-white rounded-full">{{ $cart_count }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 16 16">
                            <path fill="#000"
                                d="M2.5 2a.5.5 0 0 0 0 1h.246a.5.5 0 0 1 .48.363l1.586 5.55A1.5 1.5 0 0 0 6.254 10h4.569a1.5 1.5 0 0 0 1.393-.943l1.474-3.686A1 1 0 0 0 12.762 4H4.448l-.261-.912A1.5 1.5 0 0 0 2.746 2zm3.274 6.637L4.734 5h8.028l-1.475 3.686a.5.5 0 0 1-.464.314H6.254a.5.5 0 0 1-.48-.363M6.5 14a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m0-1a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1m4 1a1.5 1.5 0 1 0 0-3a1.5 1.5 0 0 0 0 3m0-1a.5.5 0 1 1 0-1a.5.5 0 0 1 0 1" />
                        </svg>
                    </a>
                </div>
                @if (auth()->user())
                    <div>
                        <a href="{{ route('account') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 16 16">
                                <path fill="#000"
                                    d="M10.561 8.073a6 6 0 0 1 3.432 5.142a.75.75 0 1 1-1.498.07a4.5 4.5 0 0 0-8.99 0a.75.75 0 0 1-1.498-.07a6 6 0 0 1 3.431-5.142a3.999 3.999 0 1 1 5.123 0M10.5 5a2.5 2.5 0 1 0-5 0a2.5 2.5 0 0 0 5 0" />
                            </svg>
                        </a>
                        </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Top Header End -->

    <!-- Navbar Start -->
    <nav class="bg-tertiary">
        <div
            class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl  text-sm flex items-center justify-between md:justify-start gap-10">
            <!-- Dropdown Wrapper -->
            <div x-data="{ open: false }"
                class="relative px-7 py-1 md:py-3 lg:py-4 flex items-center font-bold gap-3 bg-primary text-white w-54"
                @mouseenter="open = true" @mouseleave="open = false">
                <!-- Dropdown Toggle -->
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="#fff" fill-rule="evenodd" d="M3 16h18v2H3zm0-5h18v2H3zm0-5h18v2H3z" />
                    </svg>
                    <button>ALL CATEGORIES</button>
                </div>

                <!-- Main Dropdown Menu -->
                <div x-show="open" x-transition style="display: none;"
                    class="absolute top-full left-0 mt-2 bg-white text-black shadow-lg rounded w-56 z-50">
                    <ul class="p-0">
                        <!-- Category show -->
                        @foreach ($menus as $menu)
                            @if (count($menu->products) > 0)
                                <li x-data="{ subOpen: false }" class="relative" @mouseenter="subOpen = true"
                                    @mouseleave="subOpen = false">
                                    @php
                                        $has_child = 0;
                                    @endphp
                                    @foreach ($menu->child_cat as $menu2)
                                        @if (count($menu2->sub_products) > 0)
                                            @php
                                                ++$has_child;
                                            @endphp
                                        @endif
                                    @endforeach


                                    @if (count($menu->child_cat) > 0 && $has_child > 0)

                                    <div
                                        class="w-full text-left hover:bg-gray-200 cursor-pointer border-b p-4 flex justify-between">
                                        {{ $menu->title }}
                                            <!-- Chevron Icon -->
                                            <span>&#9656;</span>
                                    </div>

                                        <!-- Submenu -->
                                        <ul x-show="subOpen" x-transition
                                            class="absolute left-full top-0 mt-0 bg-gray-100 shadow-lg w-56">
                                            @foreach ($menu->child_cat as $menu2)
                                                @if (count($menu2->sub_products) > 0)
                                                    <li class="hover:bg-gray-200 cursor-pointer border-b p-4">
                                                        <a
                                                            href="{{ route('cate_wise.shop', [$menu->slug, $menu2->slug]) }}">{{ $menu2->title }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <a href="{{ route('cate_wise.shop', [$menu->slug]) }}">
                                            <div
                                                class="w-full text-left hover:bg-gray-200 cursor-pointer border-b p-4 flex justify-between">
                                                {{ $menu->title }}
                                                    <!-- Chevron Icon -->
                                                    <span>&#9656;</span>
                                            </div>
                                        </a>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                        {{-- <!-- Single Category without submenu -->
                        <li class="hover:bg-gray-200 cursor-pointer border-b p-4">
                            <a href="{{ route('shop') }}">Category 3</a>
                        </li> --}}
                    </ul>
                </div>
            </div>

            <!-- Navigation Menu -->
            <div>
                <div class="text-right w-full relative md:hidden" x-data="{ open: false }">
                    <!-- SVG Icon Button -->
                    <svg @click.stop="open = !open" class="cursor-pointer" xmlns="http://www.w3.org/2000/svg"
                        width="34" height="34" viewBox="0 0 24 24">
                        <path fill="#ab8e66" fill-rule="evenodd" d="M3 16h18v2H3zm0-5h18v2H3zm0-5h18v2H3z" />
                    </svg>

                    <!-- Main Dropdown Menu -->
                    <div x-show="open" x-transition @click.away="open = false"
                        class="absolute top-full right-0 mt-2 bg-white text-black shadow-lg rounded w-40 z-[9999]">
                        <ul class="p-0">
                            <!-- Category 1 -->
                            <li class="hover:bg-gray-200 cursor-pointer border-b p-4">
                                <a href="{{ route('home') }}">Home</a>
                            </li>

                            <!-- Category 2 -->
                            <li class="hover:bg-gray-200 cursor-pointer border-b p-4">
                                <a href="{{ route('shop') }}">Shop</a>
                            </li>

                            <!-- Single Category without submenu -->
                            <li class="hover:bg-gray-200 cursor-pointer border-b p-4">
                                <a href="{{ route('about_us') }}">About</a>
                            </li>
                            <li class="hover:bg-gray-200 cursor-pointer border-b p-4">
                                <a href="{{ route('blogs') }}">Blogs</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <ul class="hidden md:flex items-center gap-10 font-bold uppercase">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('about_us') }}">About</a></li>
                    <li><a href="{{ route('blogs') }}">Blogs</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

</div>

@script
    <script>
        // Session message
        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('success'))
            toastr.error("{{ session('success') }}");
        @endif

        $('.menu-toggle').click(function(e) {
            $(this).addClass('left-0');
            $('.menu').removeClass('left-[-300px]');
        })

        var menuToggle = document.querySelector('.menu-toggle');
        var menu = document.querySelector('.menu');

        menuToggle.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevents the click event from propagating to the document
            menuToggle.classList.toggle('active');
            menu.classList.toggle('active');
            toggleBodyOverflow(); // Toggle body overflow based on menu state
        });

        document.addEventListener('click', function(event) {
            var isClickInsideMenu = menu.contains(event.target);
            var isClickOnMenuToggle = menuToggle.contains(event.target);

            if (!isClickInsideMenu && !isClickOnMenuToggle) {
                menu.classList.remove('active');
                menuToggle.classList.remove('active');
                toggleBodyOverflow(); // Reset body overflow
            }
        });

        function toggleBodyOverflow() {
            // Check if menu is active and adjust body overflow
            if (menu.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }
        // Toggle search bar when clicking the search icon
        if (window.screen.width < 1280) {
            $("#search-bar").hide();
        }

        $("#search-icon").on('click', function() {
            $("#search-bar").slideToggle();
            $(this).html(function(_, oldHtml) {
                return oldHtml.includes("circle") ?
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="6"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>' :
                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="6"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>';
            });
        });

        $(document).ready(function() {
            $('.toggleBtn2').each(function(index) {
                $(this).on('click', function() {
                    //Twice handle
                    var menu = $('.toggleDiv2').eq(index);
                    if (menu.is(':visible')) {
                        menu.hide(200);
                        $(this).find('.plus').show(200);
                        $(this).find('.minus').hide(200);
                        return false;
                    } else {
                        //everythis is off
                        $('.toggleDiv2').hide(200);
                        $('.plus').show(200);
                        $('.minus').hide(200);

                        // Specific on
                        menu.show(200);
                        $(this).find('.plus').hide(200);
                        $(this).find('.minus').show(200);
                    }
                });
            });
        });
    </script>
@endscript

@assets
    @isset($pixels)
        {!! $pixels->header !!}
    @endisset
    @isset($gtags)
        {!! $gtags->header !!}
    @endisset
@endassets
