@extends('backend.layouts.master')
@push('title')
    Add Product
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Add Product</h5>
        <div class="card-body">
            @if ($errors->any())
                <div class="bg-danger text-white p-2 rounded-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-danger text-white p-2 rounded-2">
                    {{ session('error') }}
                </div>
            @endif
            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div>

                    {{-- title  --}}
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Title<span class="text-danger">*</span></label>
                        <input id="inputTitle" type="text" name="title" placeholder="Exp:- Enter title"
                            value="{{ old('title') }}" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- model  --}}
                    {{-- <div class="form-group">
                        <label for="model" class="col-form-label">Model</label>
                        <input id="model" type="text" name="model" placeholder="Exp:- Enter Model"
                            value="{{ old('model') }}" class="form-control">
                        @error('model')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- mpn  --}}
                    {{-- <div class="form-group">
                        <label for="mpn" class="col-form-label">Manufacture Name</label>
                        <input id="mpn" type="text" name="mpn" placeholder="Exp:- Enter Manufacture Name"
                            value="{{ old('mpn') }}" class="form-control">
                        @error('mpn')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- price  --}}
                    {{-- <div class="form-group">
                        <label for="price" class="col-form-label">Price(BDT)<span class="text-danger">*</span> </label>
                        <input id="price" type="text" name="price" placeholder="Exp:- Enter price" step="1"
                            value="{{ old('price') }}" class="form-control">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- discount  --}}
                    {{-- <div class="form-group">
                        <label for="discount" class="col-form-label">Discount(%)</label>
                        <input id="discount" type="number" name="discount" min="0" max="100"
                            placeholder="Exp:- Enter discount" value="{{ old('discount') ?? '0' }}" class="form-control">
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- final price  --}}
                    {{-- <div class="form-group" id="final_price_div">
                        <label for="final_price" class="col-form-label">Final Price(tk)<span
                                class="text-danger">*</span></label>
                        <input id="final_price" type="text" name="final_price" min="0" max="500000"
                            placeholder="Exp:- Enter Final Price" value="{{ old('final_price') }}" class="form-control">
                        @error('final_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- inventory cost  --}}
                    {{-- <div class="form-group">
                        <label for="inventory_cost" class="col-form-label">Inventory Cost</label>
                        <input id="inventory_cost" type="text" name="inventory_cost" min="0" max="1000000"
                            placeholder="Exp:- Enter Inventory Cost" value="{{ old('inventory_cost') ?? '0' }}"
                            class="form-control">
                        @error('inventory_cost')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- summary  --}}
                    <div class="form-group">
                        <label for="summary" class="col-form-label">Summary </label>
                        <textarea class="form-control" id="summary" name="summary">{{ old('summary') }}</textarea>
                        @error('summary')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- description  --}}
                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                        {{-- Brand  --}}
                    <x-exchangable-input-select-div label_for='brand' label_title='Brand' :select_data="$brands"
                        select_data_echo='title' />


                    {{-- {{$categories}} --}}
                    <div class="form-group" id="cat_div">
                        <label for="cat_id">Category <span class="text-danger">*</span></label>
                        <select name="cat_id" id="cat_id" class="form-control">
                            <option value="">--Select any category--</option>
                            @foreach ($categories as $key => $cat_data)
                                <option value='{{ $cat_data->id }}' @selected($cat_data->id == old('cat_id'))>{{ $cat_data->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('cat_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <x-exchangable-input-select-div label_for='child_cat' label_title='Sub Category' />
                    {{-- <div class="form-group">
                        <label for="child_cat_id">Sub Category</label>
                        <select name="child_cat" id="child_cat" class="form-control">
                            <option value="">--Select any category--</option>
                        </select>
                    </div> --}}

                    {{-- <div class="form-group">
                        <label for="condition">Condtion </label>
                        <select name="condition" id="condition" class="form-control">
                            <option value="">--Select any condition--</option>
                            <option value="Pre-Owned">Pre-Owned</option>
                            <option value="Brand New">Brand New</option>
                        </select>
                        @error('condition')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    {{-- is featured  --}}
                    <div class="form-group">
                        {{-- <label for="is_featured">Is deal of the day product</label><br> --}}
                        <input type="checkbox" name='is_featured' @checked(old('is_featured')) id='is_featured'
                            value='1'>
                        <label for="is_featured">Deal of the day</label>
                    </div>

                    {{-- <div class="form-group">
                        <label for="is_student">Is Student Laptop</label><br>
                        <input type="checkbox" name='is_student' @checked(old('is_student')) id='is_student'
                            value='1'>
                        <label for="is_student">Yes</label>
                    </div> --}}

                    {{-- upcomming  --}}
                    {{-- <div class="form-group">
                        <label for="upcomming_toggler">Up Comming</label><br>
                        <input type="checkbox" name='upcomming_toggler' @checked(old('upcomming_toggler'))
                            id='upcomming_toggler' value='1'>
                        <label for="upcomming_toggler">Yes</label>
                        <div class="ml-3" id="div_lunch_date">
                            <label for="upcomming" class="col-form-label">Product Lunch Date </label>
                            <input id="upcomming" type="date" name="upcomming"
                                placeholder="Exp:- Enter Product Lunch Date" value="{{ old('upcomming') }}"
                                class="form-control">
                            @error('upcomming')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}

                    {{-- <div class="form-group">
                        <label for="isOfferToggler">Is Offer Products</label><br>
                        <input type="checkbox" name='isOfferToggler' @checked(old('isOfferToggler')) id='isOfferToggler'
                            value='1'>
                        <label for="isOfferToggler">Yes</label>
                        <div class="ml-3" id="div_product_offer">
                            <label for="product_offer_id" class="col-form-label">Select an offer </label>
                            <select name="product_offer_id" class="form-control" id="product_offer_id">
                                <option value="" hidden>Choose....</option>
                                @foreach ($product_offers as $poffer)
                                    <option value="{{ $poffer->id }}" @selected($poffer->id == old('product_offer_id'))>
                                        {{ $poffer->title . ' (' . $poffer->dis }}%)
                                    </option>
                                @endforeach
                            </select>
                            @error('product_offer_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}

                    {{-- <div class="form-group">
                        <label for="speacial_feature">Special Features </label>
                        <select name="special_feature[]" class="form-control selectpicker" id="speacial_feature"
                            multiple>
                            <option value="" hidden>Choose....</option>
                            @foreach ($special_features as $sp)
                                <option value="{{ $sp->name }}" @selected($sp->name == old('speacial_feature'))>{{ $sp->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('speacial_feature')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}


                    {{-- stock  --}}
                    <div class="form-group">
                        <label for="stock">Stock<span class="text-danger">*</span></label>
                        <input id="quantity" type="number" name="stock" min="0" step=""
                            placeholder="Exp:- Enter quantity" value="{{ old('stock') ?? 1 }}" class="form-control">
                        @error('stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>



                {{-- Warranty Attributes --}}
                {{-- <div class="mt-4">
                    <h4>Warranty Attributes</h4>
                    <div class="ml-3">
                        <!-- replacement_warranty  -->
                        <div class="form-group">
                            <label for="replacement_warranty" class="col-form-label">Replacement Warranty</label>
                            <input id="replacement_warranty" type="text" name="replacement_warranty"
                                placeholder="2 months" value="{{ old('replacement_warranty') }}" class="form-control">
                            @error('replacement_warranty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- motherboard_warranty  -->
                        <div class="form-group">
                            <label for="motherboard_warranty" class="col-form-label">Motherboard Warranty</label>
                            <input id="motherboard_warranty" type="text" name="motherboard_warranty"
                                placeholder="1 year" value="{{ old('motherboard_warranty') }}" class="form-control">
                            @error('motherboard_warranty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- service_warranty  -->
                        <div class="form-group">
                            <label for="service_warranty" class="col-form-label">Service Warranty</label>
                            <input id="service_warranty" type="text" name="service_warranty" placeholder="Lifetime"
                                value="{{ old('service_warranty') }}" class="form-control">
                            @error('service_warranty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- disclaimer  -->
                        <div class="form-group">
                            <label for="disclaimer" class="col-form-label">Disclaimer</label>
                            <input id="disclaimer" type="text" name="disclaimer" placeholder=""
                                value="{{ old('disclaimer') }}" class="form-control">
                            @error('disclaimer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- note  -->
                        <div class="form-group">
                            <label for="note" class="col-form-label">Note</label>
                            <input id="note" type="text" name="note" placeholder=""
                                value="{{ old('note') }}" class="form-control">
                            @error('note')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- w_details  -->
                        <div class="form-group">
                            <label for="w_details" class="col-form-label">Other Warranty</label>
                            <input id="w_details" type="text" name="w_details"
                                placeholder="Exp:- 2 years warranty (Battery adapter 1 year)"
                                value="{{ old('w_details') }}" class="form-control">
                            @error('w_details')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div> --}}

                {{-- Installment process --}}
                {{-- <div class="mt-4">
                    <h4>Installment</h4>
                    <div class="ml-3">
                        <!-- installment duration  -->
                        <div class="form-group">
                            <label for="durations">Duration </label>
                            <select name="durations[]" class="form-control selectpicker" id="durations">
                                <option value="">Choose a duration</option>
                                @foreach ($durations as $duration)
                                    <option value="{{ $duration->id }}" @selected($duration->id == old('durations'))>
                                        {{ $duration->year ? $duration->year . ' years ' : ' ' }}{{ $duration->month ? $duration->month . ' month' : ' ' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('durations')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div> --}}



                {{-- serial  --}}
                <div class="form-group">
                    <label for="serial" class="col-form-label">Serial</label>
                    <input id="serial" type="number" name="serial"
                        placeholder="Exp:- 145" value="{{ old('serial') ? old('serial') : $serial }}"
                        class="form-control">
                    @error('serial')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>


                <div class="form-group">
                    <label class="col-form-label">Product Sizes</label>
                    @error('sizes')
                        <span class="text-danger d-block">{{ $message }}</span>
                    @enderror
                    <div class="size-container">
                        <div id="size-rows">
                            @if(old('sizes'))
                                @foreach(old('sizes') as $key => $size)
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <select name="sizes[{{ $key }}][display_size_id]" class="form-control">
                                                <option value="">Select Size</option>
                                                @foreach($d_sizes as $d_size)
                                                    <option value="{{ $d_size->id }}" {{ $size['display_size_id'] == $d_size->id ? 'selected' : '' }}>
                                                        {{ $d_size->size }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error("sizes.{$key}.display_size_id")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="sizes[{{ $key }}][price]"
                                                   value="{{ $size['price'] }}"
                                                   class="form-control price-input"
                                                   placeholder="Price" step="0.01">
                                            @error("sizes.{$key}.price")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="sizes[{{ $key }}][discount]"
                                                   value="{{ $size['discount'] ?? 0 }}"
                                                   class="form-control discount-input"
                                                   placeholder="Discount" step="0.01">
                                            @error("sizes.{$key}.discount")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="sizes[{{ $key }}][final_price]"
                                                   value="{{ $size['final_price'] }}"
                                                   class="form-control final-price"
                                                   placeholder="Final Price" step="0.01" readonly>
                                            @error("sizes.{$key}.final_price")
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       name="sizes[{{ $key }}][is_show]"
                                                       id="isShow_{{ $key }}"
                                                       value="1"
                                                       {{ isset($size['is_show']) ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="isShow_{{ $key }}">Show With product</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-remove-size">Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <!-- Default single size row -->
                                <div class="row mb-2">
                                    <div class="col-md-2">
                                        <select name="sizes[0][display_size_id]" class="form-control">
                                            <option value="">Select Size</option>
                                            @foreach($d_sizes as $size)
                                                <option value="{{ $size->id }}">{{ $size->size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="sizes[0][price]" class="form-control price-input"
                                               placeholder="Price" step="0.01">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="sizes[0][discount]" class="form-control discount-input"
                                               placeholder="Discount" step="0.01" value="0">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" name="sizes[0][final_price]" class="form-control final-price"
                                               placeholder="Final Price" step="0.01" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                   name="sizes[0][is_show]" id="isShow_0" value="1">
                                            <label class="custom-control-label" for="isShow_0">Show With Product</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-danger btn-remove-size">Remove</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-primary" id="add-size">Add Size</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Product Colors <span class="text-danger">*</span></label>
                    <div class="color-container">
                        <select name="colors[]" class="form-control select2"  multiple="multiple">
                            <option value="">Select Colors</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}">
                                    {{ $color->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('colors')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4 class="mt-4 mb-3">Product Images</h4>
                    </div>

                    {{-- Thumbnail Image --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="product_thumbnail_image">Product Thumbnail <span class="text-danger">*</span> <small class="text-muted">(400x400)</small></label>
                            <div class="input-group is-invalid">
                                <label class="custom-file-label" for="product_thumbnail_image">Choose file...</label>
                                <input type="file" name="product_thumbnail_image" id="product_thumbnail_image"
                                    class="custom-file-input" accept="image/*" onchange="previewImage(this, 'thumbnail-preview')">
                                </div>
                                <img id="thumbnail-preview" class="mt-2 img-fluid d-none" style="max-height: 200px">
                            @error('product_thumbnail_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- product details image  --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="photo" class="col-form-label">Photo<span class="text-danger">*</span> </label>
                            <div class="input-group is-invalid">
                                <div class="custom-file">
                                    <label class="custom-file-label" for="photo">Choose file...</label>
                                    <input name="photo[]" type="file" class="custom-file-input" id="photo" required multiple>
                                </div>
                            </div>
                            <div id="photo_show" class="d-flex"></div>
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- bottle image  --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="photo" class="col-form-label">Bottle Images<span class="text-danger">*</span> </label>
                            <div class="input-group is-invalid">
                                <div class="custom-file">
                                    <label class="custom-file-label" for="bottle_image">Choose file...</label>
                                    <input name="bottle_image[]" type="file" class="custom-file-input" id="bottle_image" required multiple>
                                </div>
                            </div>
                            <div id="bottle_image_show" class="d-flex"></div>
                            @error('bottle_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Banner Image --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="banner_image">Banner Image <small class="text-muted">(1920x500)</small></label>
                            <div class="input-group is-invalid">
                                <label class="custom-file-label" for="banner_image">Choose file...</label>
                                <input type="file" name="banner_image" id="banner_image" class="form-control"
                                    accept="image/*" onchange="previewImage(this, 'banner-preview')">
                            </div>
                            <img id="banner-preview" class="mt-2 img-fluid d-none" style="max-height: 200px">
                            @error('banner_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>


                    {{-- Best Collection Image --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="best_collection_image">Best Collection Image <small class="text-muted">(800x600)</small></label>
                            <div class="input-group is-invalid">
                                <label class="custom-file-label" for="best_collection_image">Choose file...</label>
                                <input type="file" name="best_collection_image" id="best_collection_image"
                                    class="custom-file-input" accept="image/*" onchange="previewImage(this, 'collection-preview')">
                            </div>
                            <img id="collection-preview" class="mt-2 img-fluid d-none" style="max-height: 200px">

                            @error('best_collection_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Collection Arrived Image --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="collection_arrived_image">Collection Arrived Image <small class="text-muted">(800x600)</small></label>
                            <div class="input-group is-invalid">
                                <label class="custom-file-label" for="collection_arrived_image">Choose file...</label>
                                <input type="file" name="collection_arrived_image" id="collection_arrived_image"
                                    class="custom-file-input" accept="image/*" onchange="previewImage(this, 'arrival-preview')">
                            </div>
                            <img id="arrival-preview" class="mt-2 img-fluid d-none" style="max-height: 200px">
                            @error('collection_arrived_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Instagram Image --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="instagram_image">Instagram Image <small class="text-muted">(800x800)</small></label>
                            <div class="input-group is-invalid">
                                <label class="custom-file-label" for="instagram_image">Choose file...</label>
                                <input type="file" name="instagram_image" id="instagram_image"
                                    class="custom-file-input" accept="image/*" onchange="previewImage(this, 'instagram-preview')">
                            </div>
                            <img id="instagram-preview" class="mt-2 img-fluid d-none" style="max-height: 200px">
                            @error('instagram_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Instagram Link --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="instragram_link">Instagram Link</label>
                            <input type="url" name="instragram_link" id="instragram_link" class="form-control"
                                value="{{ old('instragram_link') }}" placeholder="Instagram Link">
                            @error('instragram_link')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>


                {{-- status  --}}
                <div class="form-group">
                    <label for="status" class="col-form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status')
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

@push('styles')
    <style>
        #div_lunch_date {
            display: none;
        }

        #div_product_offer {
            display: none;
        }

        .h-6 {
            height: 32px;
        }

        .h-150px {
            height: 150px !important;
        }
        .select2-search.select2-search--inline{
            position: absolute;
        }
    </style>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote-lite.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('backend/summernote/summernote-lite.js') }}"></script>

    <script>
        // $('#lfm').filemanager('image');

        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150,
            });
            $('#description').summernote({
                placeholder: "Write detail description.....",
                tabsize: 2,
                height: 200
            });

            let show = false;
            $('#upcomming_toggler').on('click', function() {
                $('#div_lunch_date').toggle();
            });

            $('#isOfferToggler').on('click', function() {
                $('#div_product_offer').toggle();
            });
            $('#price').on('keyup', function() {
                let price_with_comma = $(this).val() ? $(this).val() : '0';
                let final_price_with_comma = $('#final_price').val() ? $('#final_price').val() : '0';

                let price = parseInt(price_with_comma.replace(/,/g, ''));
                let final_price = parseInt(final_price_with_comma.replace(/,/g, ''));
                let discount = Math.round(((price - final_price) * 100) / price);

                $('#discount').val(discount);
            });

            $('#final_price').on('keyup change', function() {
                let price_with_comma = $('#price').val() ? $('#price').val() : '0';
                let final_price_with_comma = $(this).val() ? $(this).val() : '0';

                let price = parseInt(price_with_comma.replace(/,/g, ''));
                let final_price = parseInt(final_price_with_comma.replace(/,/g, ''));
                let discount = Math.round(((price - final_price) * 100) / price);

                $('#discount').val(discount);
            });

            $('#discount').on('keyup', function() {
                let price_with_comma = $('#price').val() ? $('#price').val() : '0';
                let discount = $('#discount').val() ? $('#discount').val() : 0;
                let price = parseInt(price_with_comma.replace(/,/g, ''));
                let final_price = price - Math.round(price * discount / 100);

                $('#final_price').val(final_price);
                $('#final_price_div').show();
            });

            $('#cat_id').change(function() {
                var cat_id = $(this).val();
                // alert(cat_id);
                if (cat_id != null) {
                    // Ajax call
                    $.ajax({
                        url: "/admin/category/" + cat_id + "/child",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: cat_id
                        },
                        type: "POST",
                        success: function(response) {
                            if (typeof(response) != 'object') {
                                response = $.parseJSON(response)
                            }

                            var html_option =
                                "<option value=''>----Select sub category----</option>";
                            if (response.status) {
                                var data = response.data.child_cats;
                                if (data) {
                                    $.each(data, function(id, title) {
                                        html_option += "<option value='" + id + "'>" +
                                            title +
                                            "</option>"
                                    });
                                }
                            }
                            let other_cats = '';
                            $.each(response.data.categories, function(index, cat) {
                                other_cats += `<div class="input-group-prepend ml-1">
                                                    <div class="input-group-text bg-white">
                                                        <input id="other_cats${index}" name="other_cats_id[${index}]" value="${cat.id}" type="checkbox">
                                                    </div>
                                                    <label for="other_cats${index}" class="input-group-text">${cat.title}</label>
                                                </div>`;
                            });

                            $('#paren_other_cat').removeClass('d-none');
                            $('#other_cat_div').html(other_cats);
                            $('#child_cat').html(html_option);
                        }
                    });
                } else {}
            });


            //custom input instead of select
            $('.select_restore,.exchangable_input').hide();

            $('.input_instead_select').each(function(index) {
                $(this).on('click', function() {
                    $('.exchangable_select').eq(index).hide(100);
                    $('.exchangable_input').eq(index).show(100);
                    $(this).hide(100);
                    $('.select_restore').eq(index).show(100);
                });
            });
            $('.select_restore').each(function(index) {
                $(this).on('click', function() {
                    $('.exchangable_input').eq(index).hide(100);
                    $('.exchangable_select').eq(index).show(100);
                    $(this).hide(100);
                    $('.input_instead_select').eq(index).show(100);
                });
            });


            //photo show
            $('#photo').on('change', function(event) {
                let previews = [];
                let img = [];
                let images_div = '';
                console.log();
                let photo_length = event.target.files.length;
                let inti = 0;
                for (const file of event.target.files) {
                    ++inti;
                    const reader = new FileReader()
                    reader.onload = (e) => {
                        // console.log(e.target.result);
                        previews.push(e.target.result);
                        images_div +=
                            `<img src='${e.target.result}' alt='Not Found' class='img-thumbnail rounded h-150px'>`;
                        if (inti == photo_length) {
                            photoShow();
                        }
                        // console.log(images_div);
                    }
                    reader.readAsDataURL(file);

                }

                function photoShow() {
                    $('#photo_show').html(images_div);
                }

            });


            //bottle image show
            $('#bottle_image').on('change', function(event) {
                let previews = [];
                let img = [];
                let images_div = '';
                console.log('bottle images');
                let photo_length = event.target.files.length;
                let inti = 0;
                for (const file of event.target.files) {
                    ++inti;
                    const reader = new FileReader()
                    reader.onload = (e) => {
                        // console.log(e.target.result);
                        previews.push(e.target.result);
                        images_div +=
                            `<img src='${e.target.result}' alt='Not Found' class='img-thumbnail rounded h-150px'>`;
                        if (inti == photo_length) {
                            photoShow();
                        }
                        // console.log(images_div);
                    }
                    reader.readAsDataURL(file);

                }
                function photoShow() {
                    $('#bottle_image_show').html(images_div);
                }

            });
        });
    </script>

    <script>
        $(document).ready(function() {
            let sizeIndex = 0;

            // Calculate final price
            function calculateFinalPrice(row) {
                let price = parseFloat(row.find('.price-input').val()) || 0;
                let discount = parseFloat(row.find('.discount-input').val()) || 0;
                let finalPrice = price - discount;
                row.find('.final-price').val(finalPrice.toFixed(2));
            }

            // Add event listeners for price and discount changes
            $(document).on('input', '.price-input, .discount-input', function() {
                calculateFinalPrice($(this).closest('.row'));
            });

            // Add new size row
            $('#add-size').click(function() {
                sizeIndex++;
                let newRow = `
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <select name="sizes[${sizeIndex}][display_size_id]" class="form-control">
                                <option value="">Select Size</option>
                                @foreach($d_sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->size }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger" id="error-size-${sizeIndex}"></span>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="sizes[${sizeIndex}][price]" class="form-control price-input"
                                   placeholder="Price" step="0.01">
                            <span class="text-danger" id="error-price-${sizeIndex}"></span>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="sizes[${sizeIndex}][discount]" class="form-control discount-input"
                                   placeholder="Discount" step="0.01" value="0">
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="sizes[${sizeIndex}][final_price]" class="form-control final-price"
                                   placeholder="Final Price" step="0.01" readonly>
                        </div>
                        <div class="col-md-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       name="sizes[${sizeIndex}][is_show]" id="isShow_${sizeIndex}" value="1">
                                <label class="custom-control-label" for="isShow_${sizeIndex}">Show With product</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger btn-remove-size">Remove</button>
                        </div>
                    </div>
                `;
                $('#size-rows').append(newRow);
            });

            // Remove size row
            $(document).on('click', '.btn-remove-size', function() {
                if ($('#size-rows .row').length > 1) {
                    $(this).closest('.row').remove();
                }
            });
        });
    </script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize select2 for colors
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Select Colors',
                allowClear: true
            });
        });
    </script>

    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                }

                reader.readAsDataURL(file);
            } else {
                preview.classList.add('d-none');
            }
        }
    </script>
@endpush
