 <div
     class="bg-[#F2F2F2] h-[51px] py-4 2xl:px-[100px] xl:px-[50px] max-xl:hidden flex justify-between text-center items-center">
    <style>
        .fill-red{
            fill: red;
        }
    </style>
     <div class="relative">
         <span
             class="flex items-center whitespace-nowrap rounded font-[jost] font-[500] text-[#353535] text-[16px] bg-[#f2f2f2]"
             type="button" id="dropdownMenuButton2">
             <a class="nav-color" href="{{ route('shop') }}" wire:navigate> All Categories</a>
             <span class="w-2 ml-2 cursor-pointer menue">
                 <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                     <path fill-rule="evenodd"
                         d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                         clip-rule="evenodd" />
                 </svg>
             </span>
         </span>
         <ul
             class="submenu absolute z-[1000] float-left p-2 hidden w-[200px] list-none overflow-hidden border-none bg-[#f2f2f2] text-[#353535] text-left [&[data-te-dropdown-show]]:block">
             <li
                 class="border-b-[1px] border-[#380D37] hover:bg-[#380D37] hover:text-[#f2f2f2] active:bg-[#380D37] active:text-[#f2f2f2]">
                 <a class="block w-full whitespace-nowrap px-4 py-2 font-[jost] font-[500] text-[16px] text-[#35353]"
                     href="{{ route('shop') }}" wire:navigate>All</a>
             </li>
             @foreach ($menus as $menu)
                 @if (count($menu->products) > 0)
                     <li
                         class="border-b-[1px] border-[#380D37] hover:bg-[#380D37] hover:text-[#f2f2f2] active:bg-[#380D37] active:text-[#f2f2f2]">
                         <a class="nav-color hover-colors block w-full whitespace-nowrap px-4 py-2 font-[jost] font-[500] text-[16px] text-[#35353]"
                             href="{{ route('cate_wise.shop', [$menu->slug]) }}" wire:navigate>{{ $menu->title }}</a>
                     </li>
                 @endif
             @endforeach
         </ul>
     </div>
     @foreach ($menus as $men)
         @if (count($men->products) > 0)
             <div class="relative">
                 <span
                     class="flex items-center whitespace-nowrap rounded font-[jost] font-[500] text-[#353535] text-[16px] bg-[#f2f2f2]"
                     type="button" id="dropdownMenuButton2">
                     <a class="nav-color" href="{{ route('cate_wise.shop', [$men->slug]) }}"
                         wire:navigate>{{ $men->title }}</a>
                     @php
                         $has_child = 0;
                     @endphp
                     @foreach ($men->child_cat as $ccc)
                         @if (count($ccc->sub_products) > 0)
                             @php
                                 ++$has_child;
                             @endphp
                         @endif
                     @endforeach
                     @if (count($men->child_cat) > 0 && $has_child)
                         <span class="w-2 ml-2 cursor-pointer menue">
                             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="w-5 h-5">
                                 <path fill-rule="evenodd"
                                     d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                                     clip-rule="evenodd" />
                             </svg>
                         </span>
                     @endif
                 </span>

                 @if (count($men->child_cat) > 0 && $has_child)
                     <ul
                         class="nav-colors1 submenu absolute z-[1000] float-left p-2  hidden w-[200px] list-none overflow-hidden border-none bg-[#f2f2f2] text-[#353535] text-left [&[data-te-dropdown-show]]:block">
                         @foreach ($men->child_cat as $cc)
                             @if (count($cc->sub_products) > 0)
                                 <li
                                     class="w-full border-b-[1px] border-[#380D37] hover:bg-[#380D37] hover:text-[#f2f2f2] active:bg-[#380D37] active:text-[#f2f2f2]">
                                     <a class="nav-color hover-colors block w-full whitespace-nowrap px-4 py-2 font-[jost] font-[500] text-[16px] text-[#35353]"
                                         href="{{ route('cate_wise.shop', [$men->slug, $cc->slug]) }}"
                                         wire:navigate>{{ $cc->title }}</a>
                                 </li>
                             @endif
                         @endforeach
                     </ul>
                 @endif
             </div>
         @endif
     @endforeach

     <div class="relative">
         <a class="nav-color flex items-center whitespace-nowrap rounded font-[jost] font-[500] text-[#353535] text-[16px] bg-[#f2f2f2]"
             href="{{route('video')}}" title="Our Youtube Videos">
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="h-6 fill-red"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg>
         </a>
     </div>

     <div class="relative">
         <a class="nav-color flex items-center whitespace-nowrap rounded font-[jost] font-[500] text-[#353535] text-[16px] bg-[#f2f2f2]"
             href="tel:0171264420">
             Hotline: +8801757773557
         </a>
     </div>

     <div class="relative">
         <a class="nav-color flex items-center whitespace-nowrap rounded font-[jost] font-[500] text-[#353535] text-[16px] bg-[#f2f2f2]"
             href="{{route('review.post')}}">
             Reviews
         </a>
     </div>
 </div>
 @script
     <script>
         $(document).ready(function() {
             $('.menue').each(function(index) {
                 $(this).on('click', function() {
                     if ($('.submenu').eq(index).is(':hidden')) {
                         $('.submenu').hide(200);
                         $('.submenu').eq(index).show(200);
                     } else {
                         $('.submenu').eq(index).hide(200);
                     }
                 })
             })
             $(document).click(function(event) {
                 var dropdown = $(".menue");
                 if (!dropdown.is(event.target) && dropdown.has(event.target).length === 0) {
                    $('.submenu').hide(200);
                 }
             });
         })
     </script>
 @endscript
