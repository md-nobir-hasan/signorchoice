@extends('backend.layouts.master')
@push('title')
    Edit Videos
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Edit Videos</h5>
        <div class="card-body">
            <form method="post" action="{{ route('video.update', $datum->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="title" placeholder="Enter title"
                        value="{{ $datum->title }}" class="form-control">
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                {{-- vidoe type Type --}}
                <div class="form-group">
                    <label for="type">Videos Type<span class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-control">
                        {{-- <option value="" hidden>--Select any --</option> --}}
                        {{-- @foreach ($categories as $key => $cat_data) --}}
                        <option value='embed' @selected('embed' == $datum->type)>Embed Code (iframe) </option>
                        <option value='youtube' @selected('youtube' == $datum->type)>Yotube Video </option>
                        <option value='fb' @selected('fb' == $datum->type)>FB Video </option>
                        {{-- @endforeach --}}
                    </select>
                    @error('type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="serial" class="col-form-label">url<span class="text-danger">*</span> </label>
                    @if ($datum->type == 'youtube')
                        <input id="url" type="text" name="url" placeholder="Enter url"
                            value="https://www.youtube.com/watch?v={{ $datum->url }}" class="form-control">
                    @else
                        <input id="url" type="text" name="url" placeholder="Enter url"
                            value="{{ $datum->url }}" class="form-control">
                    @endif


                    @error('url')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Description </label>
                    <textarea class="form-control" id="summary" name="des">{{ $datum->des }}</textarea>
                    @error('summary')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="serial" class="col-form-label">Serial</label>
                    <input id="serial" type="number" name="serial" placeholder="Enter serial"
                        value="{{ $datum->serial }}" class="form-control">
                    @error('serial')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote-lite.css') }}">
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote-lite.js') }}"></script>
    <script>
        $('#lfm').filemanager('image');

        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150,
            });
        });
    </script>
@endpush
