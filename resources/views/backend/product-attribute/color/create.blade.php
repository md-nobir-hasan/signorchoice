@extends('backend.layouts.master')
@push('title')
    Add Color
@endpush
@push('styles')
    <style>
        .max-width-90px {
            max-width: 90px;
        }
    </style>
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Add Color</h5>
        <div class="card-body">
            <form method="post" action="{{ route('pa.color.store') }}">
                {{ csrf_field() }}
                <!-- color name -->
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Name <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="name" class="form-control" placeholder="Enter Name of Color"
                        value="{{ old('name') }}" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- color code -->
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Color Code <span class="text-danger">*</span></label>
                        <input id="inputTitle" type="color" name="code" class="form-control max-width-90px" placeholder="Enter Name of Color"
                        value="{{ old('code') }}" class="form-control">
                    @error('code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button class="btn btn-success" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
