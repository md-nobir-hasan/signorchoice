   <!-- Authentication Start -->
   <section class="mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl  pb-20">
       <div class="py-8 flex items-center gap-2 text-sm">
           <a href="{{ route('home') }}">Home</a>
           <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 1024 1024">
               <path fill=""
                   d="M452.864 149.312a29.12 29.12 0 0 1 41.728.064L826.24 489.664a32 32 0 0 1 0 44.672L494.592 874.624a29.12 29.12 0 0 1-41.728 0a30.59 30.59 0 0 1 0-42.752L764.736 512L452.864 192a30.59 30.59 0 0 1 0-42.688m-256 0a29.12 29.12 0 0 1 41.728.064L570.24 489.664a32 32 0 0 1 0 44.672L238.592 874.624a29.12 29.12 0 0 1-41.728 0a30.59 30.59 0 0 1 0-42.752L508.736 512L196.864 192a30.59 30.59 0 0 1 0-42.688" />
           </svg>
           <span>Login</span>
       </div>
       <h2 class="text-xl font-semibold mb-10 uppercase">Authentication</h2>
       @if (session('error'))
           <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
               <span class="block sm:inline">{{ session('error') }}</span>
               <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                   <svg onclick="this.parentElement.parentElement.remove()"
                       class="fill-current h-6 w-6 text-red-500 cursor-pointer" role="button"
                       xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                       <title>Close</title>
                       <path
                           d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                   </svg>
               </span>
           </div>
       @endif
       @if ($errs = session('errors'))
           @foreach ($errs->all() as $error)
               <div class="mb-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                   role="alert">
                   <span class="block sm:inline">{{ $error }}</span>
                   <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                       <svg onclick="this.parentElement.parentElement.remove()"
                           class="fill-current h-6 w-6 text-red-500 cursor-pointer" role="button"
                           xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                           <title>Close</title>
                           <path
                               d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.698z" />
                       </svg>
                   </span>
               </div>
           @endforeach
       @endif
       <div class="grid grid-cols-1 md:grid-cols-2 gap-7">
           {{-- Login form  --}}
           <div>
               <h3 class="px-10 py-6 border rounded-t-lg">Login your Account</h3>
               <div class="px-10 py-6 border border-t-0 rounded-b-lg">
                   {{-- <p class="text-secondary mb-5">Login with social account</p> --}}
                   {{-- <div class="flex items-center gap-10 mb-5">
                       <a href="#" class="text-sm flex items-center gap-2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                               <g fill="none">
                                   <path
                                       d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                   <path fill="currentColor"
                                       d="M4.594 4.984a1 1 0 0 1 .941.429C7.011 7.572 8.783 8.47 10.75 8.674c.096-.841.323-1.672.75-2.404c.626-1.074 1.644-1.864 3.098-2.156c2.01-.404 3.54.324 4.427 1.215l1.792-.335a1 1 0 0 1 1.053 1.478l-1.72 3.022c.157 4.361-1.055 7.405-3.639 9.502c-1.37 1.112-3.332 1.743-5.485 1.938c-2.17.196-4.623-.041-7.061-.753a1 1 0 0 1 .007-1.922c1.226-.349 2.16-.65 3.003-1.177c-1.199-.636-2.082-1.468-2.707-2.416c-.868-1.318-1.19-2.788-1.254-4.113S3.141 8 3.343 7.115c.115-.505.249-1.011.434-1.495a1 1 0 0 1 .818-.636Z" />
                               </g>
                           </svg>
                           <span>Google</span>
                       </a>
                       <a href="#" class="text-sm flex items-center gap-2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24">
                               <path fill="currentColor" fill-rule="evenodd"
                                   d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6z"
                                   clip-rule="evenodd" />
                           </svg>
                           <span>Facebook</span>
                       </a>
                   </div> --}}
                   <form action="{{ route('login.submit') }}" method="POST">
                       @csrf
                       <div>
                           <div class="mb-5">
                               <label class="text-sm mb-1">Email</label>
                               <input name="email" class="py-2 px-5 border w-full rounded-full" type="email" />
                               @error('email')
                                   <span class="text-red-500 text-sm">{{ $message }}</span>
                               @enderror
                           </div>
                           <div class="mb-5">
                               <label class="text-sm mb-1">Password</label>
                               <input name="password" class="py-2 px-5 border w-full rounded-full" type="password" />
                               @error('password')
                                   <span class="text-red-500 text-sm">{{ $message }}</span>
                               @enderror
                           </div>
                           <div class="mb-5 flex items-center justify-between">
                               <div class="flex items-center gap-1">
                                   <input wire:model="remember" type="checkbox" />
                                   <span class="text-sm text-secondary">Remember Me</span>
                               </div>
                               <a href="{{route('user.fp')}}" class="text-sm">Forgot password?</a>
                           </div>

                           <button type="submit" class="py-2 px-5 text-white bg-primary rounded-full text-sm">
                               LOGIN
                           </button>
                       </div>
                   </form>
               </div>
           </div>


           {{-- registration form  --}}
           <div>

               <h3 class="px-10 py-6 border rounded-t-lg">Register now</h3>
               <div class="px-10 py-6 border border-t-0 rounded-b-lg">
                   {{-- <p class="text-secondary mb-5">Login with social account</p> --}}
                   <form action="{{ route('register.submit') }}" method="POST">
                       @csrf
                       <div>
                           <div class="mb-5">
                               <label class="text-sm mb-1">Your email</label>
                               <input name="email" class="py-2 px-5 border w-full rounded-full" type="email" />
                               @error('email')
                                   <span class="text-red-500 text-sm">{{ $message }}</span>
                               @enderror
                           </div>
                           <div class="mb-5">
                               <label class="text-sm mb-1">Username</label>
                               <input name="name" class="py-2 px-5 border w-full rounded-full" type="text" />
                               @error('name')
                                   <span class="text-red-500 text-sm">{{ $message }}</span>
                               @enderror
                           </div>
                           <div class="mb-5">
                               <label class="text-sm mb-1">Password</label>
                               <input name="password" class="py-2 px-5 border w-full rounded-full" type="password" />
                               @error('password')
                                   <span class="text-red-500 text-sm">{{ $message }}</span>
                               @enderror
                           </div>
                           <div class="mb-5">
                               <div class="flex items-center gap-1">
                                   <input id="terms" name="terms" type="checkbox" />
                                   <label for="terms" class="text-sm text-secondary">
                                       I agree to
                                       <span class="text-black">Terms & Conditions</span>
                                   </label>
                               </div>
                               @error('terms')
                                   <span class="text-red-500 text-sm">{{ $message }}</span>
                               @enderror
                           </div>
                           <button type="submit" class="py-2 px-5 text-white bg-primary rounded-full text-sm">
                               Register Now
                           </button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </section>
   <!-- Authentication End -->
