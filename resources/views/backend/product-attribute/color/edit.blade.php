@extends('backend.layouts.master')
@push('title')
    Update Color
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Update Color</h5>
        <div class="card-body">
            <form method="post" action="{{ route('pa.color.update',$datum->id) }}">
                {{ csrf_field() }}
                @method('PUT')

                <!-- color name -->
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Color <span class="text-danger">*</span>

                    </label>
                    <input id="inputTitle" type="text" name="name" placeholder="Enter Name of Color"
                    value="{{$datum->name}}" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- color code -->
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Color Code <span class="text-danger">*</span>
                        <input id="inputTitle" type="color" name="code" placeholder="Enter Name of Color"
                        value="{{$datum->code}}" class="form-control">
                    </label>
                    @error('code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 form-group">
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
