<div>
    <!-- Footer Section Start  -->
    <footer class="pt-20 bg-tertiary">
        <div class="grid grid-cols-2 gap-5 md:grid-cols-3 mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            <div class="md:order-1">
                <ul class="flex items-center flex-col justify-center gap-1">
                    <li class="text-sm font-medium uppercase">
                        <a href="#">Quick Menu</a>
                    </li>
                    <li class="transition-all duration-150 cursor-pointer">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class=" transition-all duration-150 cursor-pointer">
                        <a href="{{ route('about_us') }}">About</a>
                    </li>
                    <li class="transition-all duration-150 cursor-pointer">
                        <a href="{{ route('blogs') }}">Blogs</a>
                    </li>
                    <li class=" transition-all duration-150 cursor-pointer">
                        <a href="{{ route('user.login') }}">Login</a>
                    </li>
                </ul>
            </div>
            <div class="order-3 col-span-2 md:col-span-1 md:order-2 p-5 md:p-0">
                <h3 class="text-sm font-semibold uppercase mb-4 text-center">
                    Newsletter
                </h3>
                <p class="text-center mb-5 text-hard">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Consequatur, eaque!
                </p>
                <input class="py-2 h-14 px-5 w-full text-hard outline-primary outline-1 rounded-full mb-2 shadow"
                    placeholder="Your email letter" />
                <button
                    class="h-14 py-2 px-5 w-full text-white bg-primary uppercase font-bold text-xs rounded-full mb-2">
                    Subscribe
                </button>
                <div class="pt-5 flex items-center justify-evenly mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path fill="#000"
                            d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g fill="none">
                            <path
                                d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                            <path fill="#000"
                                d="M4.594 4.984a1 1 0 0 1 .941.429C7.011 7.572 8.783 8.47 10.75 8.674c.096-.841.323-1.672.75-2.404c.626-1.074 1.644-1.864 3.098-2.156c2.01-.404 3.54.324 4.427 1.215l1.792-.335a1 1 0 0 1 1.053 1.478l-1.72 3.022c.157 4.361-1.055 7.405-3.639 9.502c-1.37 1.112-3.332 1.743-5.485 1.938c-2.17.196-4.623-.041-7.061-.753a1 1 0 0 1 .007-1.922c1.226-.349 2.16-.65 3.003-1.177c-1.199-.636-2.082-1.468-2.707-2.416c-.868-1.318-1.19-2.788-1.254-4.113S3.141 8 3.343 7.115c.115-.505.249-1.011.434-1.495a1 1 0 0 1 .818-.636Z" />
                        </g>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <g fill="none" stroke="#000" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 16a4 4 0 1 0 0-8a4 4 0 0 0 0 8" />
                            <path d="M3 16V8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="m17.5 6.51l.01-.011" />
                        </g>
                    </svg>
                </div>
                <p class="pb-5 text-center text-hard">
                    Copyright &copy; 2025 SIGNORCHOICE. All Rights Reserved
                </p>
            </div>
            <div class="order-2 md:order-3">
                <ul class="flex items-center flex-col justify-center gap-1">
                    <li class="text-sm font-medium uppercase">
                        <a href="#">Information</a>
                    </li>
                    <li class="transition-all duration-150 cursor-pointer">
                        <a href="{{ route('contact') }}">Contact Us</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    {{-- Footer Menu Start --}}
    {{-- <section class="md:hidden grid grid-cols-2 border border-t bg-white fixed bottom-0 w-full py-1 ">
        <div class=" flex flex-col gap-1 items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 512 512">
                <path fill="currentColor"
                    d="M261.56 101.28a8 8 0 0 0-11.06 0L66.4 277.15a8 8 0 0 0-2.47 5.79L63.9 448a32 32 0 0 0 32 32H192a16 16 0 0 0 16-16V328a8 8 0 0 1 8-8h80a8 8 0 0 1 8 8v136a16 16 0 0 0 16 16h96.06a32 32 0 0 0 32-32V282.94a8 8 0 0 0-2.47-5.79Z" />
                <path fill="currentColor"
                    d="m490.91 244.15l-74.8-71.56V64a16 16 0 0 0-16-16h-48a16 16 0 0 0-16 16v32l-57.92-55.38C272.77 35.14 264.71 32 256 32c-8.68 0-16.72 3.14-22.14 8.63l-212.7 203.5c-6.22 6-7 15.87-1.34 22.37A16 16 0 0 0 43 267.56L250.5 69.28a8 8 0 0 1 11.06 0l207.52 198.28a16 16 0 0 0 22.59-.44c6.14-6.36 5.63-16.86-.76-22.97" />
            </svg>
            <!-- <span>Home</span> -->
        </div>
        <div class=" flex flex-col gap-1 items-center justify-center">
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M10 2.25a1.75 1.75 0 0 0-1.582 1c-.684.006-1.216.037-1.692.223A3.25 3.25 0 0 0 5.3 4.563c-.367.493-.54 1.127-.776 1.998l-.047.17l-.513 2.964q-.277.191-.486.459c-.901 1.153-.472 2.87.386 6.301c.545 2.183.818 3.274 1.632 3.91C6.31 21 7.435 21 9.685 21h4.63c2.25 0 3.375 0 4.189-.635c.814-.636 1.086-1.727 1.632-3.91c.858-3.432 1.287-5.147.386-6.301a2.2 2.2 0 0 0-.487-.46l-.513-2.962l-.046-.17c-.237-.872-.41-1.506-.776-2a3.25 3.25 0 0 0-1.426-1.089c-.476-.186-1.009-.217-1.692-.222A1.75 1.75 0 0 0 14 2.25zm8.418 6.896l-.362-2.088c-.283-1.04-.386-1.367-.56-1.601a1.75 1.75 0 0 0-.768-.587c-.22-.086-.486-.111-1.148-.118A1.75 1.75 0 0 1 14 5.75h-4a1.75 1.75 0 0 1-1.58-.998c-.663.007-.928.032-1.148.118a1.75 1.75 0 0 0-.768.587c-.174.234-.277.56-.56 1.6l-.362 2.089C6.58 9 7.91 9 9.685 9h4.63c1.775 0 3.105 0 4.103.146M8 12.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0v-4a.75.75 0 0 1 .75-.75m8.75.75a.75.75 0 0 0-1.5 0v4a.75.75 0 0 0 1.5 0zM12 12.25a.75.75 0 0 1 .75.75v4a.75.75 0 0 1-1.5 0v-4a.75.75 0 0 1 .75-.75"
                        clip-rule="evenodd" />
                </svg>
                <div
                    class="w-4 h-4 rounded-full bg-primary text-white absolute top-0 -right-1 flex items-center justify-center text-xs">
                    0
                </div>
            </div>
           <!-- <span>Cart</span> -->
        </div>
    </section> --}}
    {{-- Footer Menu End --}}

    <!-- Back To TOP Start -->
    <div id="scrollButton"
        class="w-12 h-12 rounded-full items-center justify-center fixed bottom-14 right-5 bg-primary z-[9999] hidden cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16">
            <path fill="#fff" fill-rule="evenodd"
                d="m8 4.293l3.854 3.853l-.707.708L8 5.707L4.854 8.854l-.708-.708zm0 3l3.854 3.853l-.707.708L8 8.707l-3.146 3.147l-.708-.707z"
                clip-rule="evenodd" />
        </svg>
    </div>

    <!-- Back To TOP End -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const scrollButton = document.getElementById('scrollButton');
            const scrollDistance = 100; // Adjust the scroll distance as needed

            // Show/hide the button based on scroll position
            window.addEventListener('scroll', () => {
                if (window.scrollY > scrollDistance) {
                    scrollButton.classList.add('flex');
                    scrollButton.classList.remove('hidden');
                } else {
                    scrollButton.classList.remove('flex');
                    scrollButton.classList.add('hidden');
                }
            });

            // Scroll to the top when the button is clicked
            scrollButton.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth' // Adds smooth scrolling animation
                });
            });
        });
        const swiper = new Swiper(".hero-swiper", {
            // Optional parameters
            // direction: "vertical",
            loop: true,

            autoplay: {
                delay: 7000,
                disableOnInteraction: false,
            },

            // If we need pagination
            pagination: {
                clickable: true,
                el: ".hero-swiper-pagination",
                // renderBullet: function (index, className) {
                //   return '<span class="' + className + '">' + (index + 1) + "</span>";
                // },
            },

            // Navigation arrows
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

            // And if we need scrollbar
            scrollbar: {
                el: ".swiper-scrollbar",
            },
        });
        const dealsOfTheDayswiper = new Swiper(".deals-of-the-day-swiper", {
            // Optional parameters
            // direction: "vertical",
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
            autoplay: {
                delay: 5000,
                // disableOnInteraction: false,
            },

            // If we need pagination
            pagination: {
                el: ".deals-of-the-day-swiper-pagination",
                clickable: true,
            },
        });
        const newsSwiper = new Swiper(".news-swiper", {
            // Optional parameters
            // direction: "vertical",
            slidesPerView: 1,
            spaceBetween: 10,
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
            autoplay: {
                delay: 5000,
                // disableOnInteraction: false,
            },

            // If we need pagination
            pagination: {
                el: ".news-swiper-pagination",
                // clickable: true,
            },
        });
        const instagramSwiper = new Swiper(".instagram-swiper", {
            // Optional parameters
            // direction: "vertical",
            slidesPerView: 1,
            loop: true,
            breakpoints: {
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 5,
                },
                1024: {
                    slidesPerView: 6,
                },
            },
            autoplay: {
                delay: 5000,
                // disableOnInteraction: false,
            },

            // If we need pagination
            pagination: {
                el: ".news-swiper-pagination",
                // clickable: true,
            },
        });
    </script>
</div>
@assets
    {{-- add to cart functionality by jquery --}}
    <script>
        //   $(document).ready(function() {
        //       const sc = $('#side_cart');
        //       // sc.hide();

        //       //close side cart
        //       $(document).on('click', '#side_cart_close', function() {
        //           $("#side_cart").hide(300);
        //       });
        //       let cart_product_no = $('.cart-product').length - 1;
        //       //open cart by clicking on add to cart
        //       // $('.add-to-cart').on('click', function() {
        //       $(document).on('click', '.add-to-cart', function() {
        //           cart_product_no += 1;
        //           const p_id = $(this).prop('id');
        //           $.ajax({
        //               type: "get",
        //               url: "{{ route('add_to_cart') }}",
        //               data: {
        //                   pid: p_id
        //               },
        //               dataType: "json",
        //               success: function(response) {
        //                   if (response.msg) {
        //                       toastr.error(response.msg);
        //                   } else {
        //                       const product = `
    //                         <div x-data="{
    //                                 qty: 1,
    //                                 price:'${response.product.price.replace(/,/g,'')}',
    //                                 dis_price:'${response.product.final_price.replace(/,/g,'')}',
    //                                 subtotal:0,
    //                                 cp_show:true,
    //                                 setup() {
    //                                     this.subtotal = Number(this.dis_price) * Number(this.qty);
    //                                     total = Number(total) + Number(this.subtotal);
    //                                 },
    //                                 priceCal(new_qty) {
    //                                     const new_subtotal = new_qty * Number(this.dis_price);
    //                                     total = total - Number(this.subtotal) + new_subtotal;
    //                                     this.subtotal = new_subtotal;
    //                                 },
    //                                 mplus() {
    //                                     if(this.qty>= 5){
    //                                         toastr.warning('You can not add more then 5 products');
    //                                         return false;
    //                                     }
    //                                     $.ajax({
    //                                             url:'{{ route('plus') }}',
    //                                             method:'get',
    //                                             data:{id:${response.id}},
    //                                             success:(res)=>{
    //                                                 if(res.msg){
    //                                                     toastr.warning(res.msg)
    //                                                 }else{
    //                                                     this.priceCal(++this.qty);
    //                                                     console.log('Successfully decrease quantity')
    //                                                 }
    //                                             }
    //                                         });
    //                                 }, mminus() {
    //                                     if(this.qty <= 1){
    //                                         toastr.warning('You can not remove all quantity');
    //                                         return false;
    //                                     }
    //                                     $.ajax({
    //                                             url:'{{ route('minus') }}',
    //                                             method:'get',
    //                                             data:{id:${response.id}},
    //                                             success:(res)=>{
    //                                                 if(res.msg){
    //                                                     toastr.warning(res.msg)
    //                                                 }else{
    //                                                     this.priceCal(--this.qty)
    //                                                     console.log('Successfully decrease quantity')
    //                                                 }
    //                                             }
    //                                         });

    //                                 },removeProd(){
    //                                     $.ajax({
    //                                             url:'{{ route('delete') }}',
    //                                             method:'get',
    //                                             data:{id:${response.id},mt:'Cart'},
    //                                             success:(res)=>{
    //                                                 if(res.msg){
    //                                                     toastr.warning(res.msg)
    //                                                 }else{
    //                                                     this.priceCal(0)
    //                                                     this.cp_show = false;
    //                                                     let cart_count =  Number($('.cart_count:eq(1)').text());
    //                                                     $('.cart_count').text(cart_count-1);
    //                                                 }
    //                                             }
    //                                         });
    //                                 } }" x-init='setup()' x-show='cp_show'
    //                             class='cart-product flex justify-around mt-[10px] border-t-[#3535354D] border-t-[2px] border-b-[#3535354D] border-b-[2px] py-[10px] px-[5px] gap-[10px]'>

    //                             <input type="hidden" name="cps[${cart_product_no}][product_id]"
    //                                 value="${response.product_id}">
    //                             <input type="hidden" name="cps[${cart_product_no}][qty]"
    //                                 value="${response.id}">
    //                             <div class='flex items-center'>
    //                                 <img class="w-[80px] h-[px]" src="${response.product.photo ? response.product.photo.split(',')[0] : '/backend/img/thumbnail-default.jpg' }"
    //                                     alt="${response.product.title}">
    //                             </div>

    //                             <div>
    //                                 <div>
    //                                     <p class='text-[12px] text-[#380D37] font-[jost] font-[500]'>
    //                                         ${response.product.title}
    //                                     </p>
    //                                 </div>
    //                                 <div
    //                                     class='border-[#380D37] w-[85px] h-[19.231px] border-[2px] rounded-[4px] my-[10px] flex items-center justify-around'>
    //                                     <span @click="mminus"
    //                                         class='cplus text-[#380D37] h-[19.231px] border-[#380D37] border-r-[2px] pr-[5px] flex items-center cursor-pointer  text-center'>-</span>
    //                                     <span x-text="qty"
    //                                     class='text-[#380D37] h-[19.231px] w-[40px] border-[#380D37] border-r-[2px]  flex items-center  justify-center'
    //                                         >

    //                                     </span>
    //                                     <span @click="mplus"
    //                                         class='cplus text-[#380D37] h-[19.231px] pr-[5px] flex items-center cursor-pointer text-center'>+</span>
    //                                 </div>
    //                                 <div>
    //                                     <p class='text-[#353535] text-[16px] font-[jost] font-[500] text-center'>
    //                                         <span x-text="qty"></span> x <span class='text-[#DC275C]'> ${response.product.final_price}</span>
    //                                         TAKA
    //                                     </p>

    //                                 </div>
    //                             </div>

    //                             <div>
    //                                 <span @click="removeProd" class="cursor-pointer cart_prd_delete">
    //                                     <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
    //                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
    //                                         <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
    //                                     </svg>
    //                                 </span>
    //                             </div>
    //                         </div>`;

        //                       $('#side_cart_body').append(product);
        //                       $('#side_cart').show(500);
        //                       let cart_count = Number($('.cart_count:eq(1)').text());
        //                       $('.cart_count').text(cart_count + 1);
        //                   }
        //               }
        //           });
        //       })

        //   })
    </script>
    @isset($pixels)
        {!! $pixels->footer !!}
    @endisset
    @isset($gtags)
        {!! $gtags->footer !!}
    @endisset
@endassets
