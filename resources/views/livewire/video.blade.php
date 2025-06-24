@assets
    <script async defer src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2"></script>
@endassets
<div>
    <h1 class="text-center text-2xl font-extrabold underline pt-5">Videos</h1>
    <div class="py-6 px-12">
        <style>
            iframe{
                height: 100% !important;
                width: 100% !important;
            }
        </style>
        {{-- <div id="fb-root"></div> --}}
        <div
            class='grid grid-cols-4 max-lg:grid-cols-3 max-sm:grid-cols-2 gap-8 max-sm:gap-[5px] mx-auto mt-4'>
            @foreach ($videos as $video)
                @if ($video->type == 'fb')
                    <div class="fb-video" data-href="{{ $video->url }}" data-width="" id="videos{{ $video->serial }}"
                        data-show-text="false">
                        <div class="fb-xfbml-parse-ignore">
                            <blockquote cite="{{ $video->url }}">
                                {{-- <a href="{{ $video->url }}" target="_blank"> {{ $video->title }}</a>
                                <p>{!! $video->des !!}</p>
                                Posted by <a href="{{ route('video') }}#mdnh{{ $video->serial }}">LappyValley</a> on
                                {{ $video->created_at->format('d-M-Y') }} --}}
                            </blockquote>
                        </div>
                    </div>
                @elseif($video->type == 'youtube')
                    <div class="">
                        <iframe class="" src="https://www.youtube.com/embed/{{ $video->url }}" allowfullscreen=""
                            data-gtm-yt-inspected-2340190_699="true"></iframe>
                    </div>
                @elseif($video->type == 'embed')
                    <div>
                        {!! $video->url !!}
                    </div>
                @endif
            @endforeach
        </div>
        <div class="mt-8">
            {{ $videos->links('vendor.pagination.tailwind') }}
        </div>
    </div>
    <!-- Load Facebook SDK for JavaScript -->



</div>
