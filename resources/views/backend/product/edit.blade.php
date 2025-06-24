@extends('backend.layouts.master')
@push('title')
    Edit Product
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Edit Product</h5>
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
            <form method="post" action="{{ route('product.update', [$product->id]) }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PUT')
                <div>
                    <div class="form-group">
                        <label for="inputTitle" class="col-form-label">Title<span class="text-danger">*</span> </label>
                        <input id="inputTitle" type="text" name="title" placeholder="Exp:- Enter title"
                            value="{{ $product->title }}" class="form-control">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    {{--
                    <div class="form-group">
                        <label for="model" class="col-form-label">Model </label>
                        <input id="model" type="text" name="model" placeholder="Exp:- Enter Model"
                            value="{{ $product->model }}" class="form-control">
                        @error('model')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="mpn" class="col-form-label">Manufacture Name </label>
                        <input id="mpn" type="text" name="mpn" placeholder="Exp:- Enter Manufacture Name"
                            value="{{ $product->mpn }}" class="form-control">
                        @error('mpn')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price" class="col-form-label">Price(BDT)<span class="text-danger">*</span> </label>
                        <input id="price" type="text" name="price" placeholder="Exp:- Enter price" step="1"
                            value="{{ $product->price }}" class="form-control">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discount" class="col-form-label">Discount(%)</label>
                        <input id="discount" type="number" name="discount" min="0" max="100"
                            placeholder="Exp:- Enter discount" value="{{ $product->discount }}" class="form-control">
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group" id="final_price_div">
                        <label for="final_price" class="col-form-label">Final Price(tk)<span
                                class="text-danger">*</span></label>
                        <input id="final_price" type="text" name="final_price" min="0" max="500000"
                            placeholder="Exp:- Enter Final Price" value="{{ $product->final_price }}" class="form-control">
                        @error('final_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="inventory_cost" class="col-form-label">Inventory Cost</label>
                        <input id="inventory_cost" type="text" name="inventory_cost" min="0" max="1000000"
                            placeholder="Exp:- Enter Inventory Cost" value="{{ $product->inventory_cost }}"
                            class="form-control">
                        @error('inventory_cost')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <div class="form-group">
                        <label for="summary" class="col-form-label">Summary </label>
                        <textarea class="form-control" id="summary" name="summary">{!! $product->summary !!}</textarea>
                        @error('summary')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="col-form-label">Description</label>
                        <textarea class="form-control" id="description" name="description">{!! $product->description !!}</textarea>
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Brand  --}}
                    <x-exchangable-input-select-div label_for='brand' label_title='Brand' :select_data="$brands"
                        select_data_echo='title' :id_for_selected="$product->brand_id" />

                    {{-- {{$categories}} --}}
                    <div class="form-group">
                        <label for="cat_id">Category </label>
                        <select name="cat_id" id="cat_id" class="form-control">
                            <option value="">--Select any category--</option>
                            @foreach ($categories as $key => $cat_data)
                                <option value='{{ $cat_data->id }}' @selected($cat_data->id == $product->cat_id)>{{ $cat_data->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- sub categories --}}
                    <x-exchangable-input-select-div label_for='child_cat' label_title='Sub Category' :select_data="$sub_categories"
                        select_data_echo='title' :id_for_selected="$product->child_cat_id" />


                    <div class="form-group">
                        <label for="is_featured">Is Featured</label><br>
                        <input type="checkbox" name='is_featured' @checked($product->is_featured) id='is_featured'
                            value='1'>
                        <label for="is_featured">Yes</label>
                    </div>

                    {{--
                    <div class="form-group">
                        <label for="upcomming_toggler">Up Comming</label><br>
                        <input type="checkbox" name='upcomming_toggler' @checked($product->upcomming)
                            id='upcomming_toggler' value='1'>
                        <label for="upcomming_toggler">Yes</label>
                        <div class="ml-3" id="div_lunch_date">
                            <label for="upcomming" class="col-form-label">Product Lunch Date </label>
                            <input id="upcomming" type="date" name="upcomming"
                                placeholder="Exp:- Enter Product Lunch Date" value="{{ $product->upcomming }}"
                                class="form-control">
                            @error('upcomming')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label for="stock">Stock<span class="text-danger">*</span> </label>
                        <input id="quantity" type="number" name="stock" min="0" step="1"
                            placeholder="Exp:- Enter quantity" value="{{ $product->stock }}" class="form-control">
                        @error('stock')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>


                {{-- serial  --}}
                <div class="form-group">
                    <label for="serial" class="col-form-label">Serial</label>
                    <input id="serial" type="number" name="serial"
                        placeholder="Exp:- 145" value="{{ old('serial',$product->serial) }}"
                        class="form-control">
                    @error('serial')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Warranty Attributes --}}
                {{-- <div class="mt-4">
                    <h4>Warranty Attributes</h4>
                    <div class="ml-3">
                        <!-- replacement_warranty  -->
                        <div class="form-group">
                            <label for="replacement_warranty" class="col-form-label">Replacement Warranty</label>
                            <input id="replacement_warranty" type="text" name="replacement_warranty"
                                placeholder="2 months" value="{{ $product->replacement_warranty }}"
                                class="form-control">
                            @error('replacement_warranty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- motherboard_warranty  -->
                        <div class="form-group">
                            <label for="motherboard_warranty" class="col-form-label">Motherboard Warranty</label>
                            <input id="motherboard_warranty" type="text" name="motherboard_warranty"
                                placeholder="1 year" value="{{ $product->motherboard_warranty }}" class="form-control">
                            @error('motherboard_warranty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- service_warranty  -->
                        <div class="form-group">
                            <label for="service_warranty" class="col-form-label">Service Warranty</label>
                            <input id="service_warranty" type="text" name="service_warranty" placeholder="Lifetime"
                                value="{{ $product->service_warranty }}" class="form-control">
                            @error('service_warranty')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- disclaimer  -->
                        <div class="form-group">
                            <label for="disclaimer" class="col-form-label">Disclaimer</label>
                            <input id="disclaimer" type="text" name="disclaimer" placeholder=""
                                value="{{ $product->disclaimer }}" class="form-control">
                            @error('disclaimer')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- note  -->
                        <div class="form-group">
                            <label for="note" class="col-form-label">Note</label>
                            <input id="note" type="text" name="note" placeholder=""
                                value="{{ $product->note }}" class="form-control">
                            @error('note')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- w_details  -->
                        <div class="form-group">
                            <label for="w_details" class="col-form-label">Other Warranty</label>
                            <input id="w_details" type="text" name="w_details"
                                placeholder="Exp:- 2 years warranty (Battery adapter 1 year)"
                                value="{{ $product->w_details }}" class="form-control">
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
                                @foreach ($durations as $duration)
                                    <option value="{{ $duration->id }}" @selected($duration->id == $product->installment?->id)>
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


                {{-- Manual upload Photo  --}}
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
                            <img id="thumbnail-preview" src="{{ $product->thumbnail_url }}"
                                 class="mt-2 img-fluid {{ $product->product_thumbnail_image ? '' : 'd-none' }}"
                                 style="max-height: 200px">
                            @if($product->product_thumbnail_image)
                                <div class="mt-2">
                                    <label class="d-flex align-items-center">
                                        <input type="checkbox" name="remove_product_thumbnail_image" value="1">
                                        <span class="ml-2">Remove thumbnail image</span>
                                    </label>
                                </div>
                            @endif
                            @error('product_thumbnail_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Product Details Images --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="photo" class="col-form-label">Photo<span class="text-danger">*</span></label>
                            <div class="input-group is-invalid">
                                <div class="custom-file">
                                    <label class="custom-file-label" for="photo">Choose file...</label>
                                    <input name="photo[]" type="file" class="custom-file-input" id="photo" multiple>
                                </div>
                            </div>
                            <div id="photo_show" class="d-flex mt-2">
                                {{-- @dd(count($product->photo_formatted),$product->photo) --}}
                                @if($product->photo)
                                    @foreach($product->photo_formatted as $photo)
                                        <div class="position-relative mr-2">
                                            <img src="{{ $photo }}" class="img-thumbnail" style="max-height: 100px">
                                            <input type="hidden" name="remaining_photos[]" value="{{ $photo }}">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute"
                                                    style="top: 0; right: 0;" onclick="removePhoto(this)">×</button>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div id="new_photo_show" class="d-flex mt-2">

                            </div>
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                      {{-- Product Bottle Images --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="bottle_image" class="col-form-label">Bottle Images<span class="text-danger">*</span></label>
                            <div class="input-group is-invalid">
                                <div class="custom-file">
                                    <label class="custom-file-label" for="bottle_image">Choose file...</label>
                                    <input name="bottle_image[]" type="file" class="custom-file-input" id="bottle_image" multiple>
                                </div>
                            </div>
                            <div id="bottle_image_show" class="d-flex mt-2">
                                {{-- @dd(count($product->photo_formatted),$product->photo) --}}
                                {{-- @dd($product->bottle_images,$product->bottle_image_formatted) --}}
                                @if($product->bottle_images)

                                    @foreach($product->bottle_image_formatted as $bottle_image)
                                        <div class="position-relative mr-2">
                                            <img src="{{ $bottle_image }}" class="img-thumbnail" style="max-height: 100px">
                                            <input type="hidden" name="remaining_bottle_images[]" value="{{ $bottle_image }}">
                                            <button type="button" class="btn btn-danger btn-sm position-absolute"
                                                    style="top: 0; right: 0;" onclick="removeBottleImage(this)">×</button>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                            <div id="new_bottle_image_show" class="d-flex mt-2">

                            </div>
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
                                <input type="file" name="banner_image" id="banner_image" class="custom-file-input"
                                    accept="image/*" onchange="previewImage(this, 'banner-preview')">
                            </div>
                            <img id="banner-preview" src="{{ $product->banner_url }}"
                                 class="mt-2 img-fluid {{ $product->banner_image ? '' : 'd-none' }}"
                                 style="max-height: 200px">
                            @if($product->banner_image)
                                <div class="mt-2">
                                    <label class="d-flex align-items-center">
                                        <input type="checkbox" name="remove_banner_image" value="1">
                                        <span class="ml-2">Remove banner image</span>
                                    </label>
                                </div>
                            @endif
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
                            <img id="collection-preview" src="{{ $product->best_collection_url }}"
                                 class="mt-2 img-fluid {{ $product->best_collection_image ? '' : 'd-none' }}"
                                 style="max-height: 200px">
                            @if($product->best_collection_image)
                                <div class="mt-2">
                                    <label class="d-flex align-items-center">
                                        <input type="checkbox" name="remove_best_collection_image" value="1">
                                        <span class="ml-2">Remove collection image</span>
                                    </label>
                                </div>
                            @endif
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
                            <img id="arrival-preview" src="{{ $product->collection_arrived_url }}"
                                 class="mt-2 img-fluid {{ $product->collection_arrived_image ? '' : 'd-none' }}"
                                 style="max-height: 200px">
                            @if($product->collection_arrived_image)
                                <div class="mt-2">
                                    <label class="d-flex align-items-center">
                                        <input type="checkbox" name="remove_collection_arrived_image" value="1">
                                        <span class="ml-2">Remove arrival image</span>
                                    </label>
                                </div>
                            @endif
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
                            <img id="instagram-preview" src="{{ $product->instagram_url }}"
                                 class="mt-2 img-fluid {{ $product->instagram_image ? '' : 'd-none' }}"
                                 style="max-height: 200px">
                            @if($product->instagram_image)
                                <div class="mt-2">
                                    <label class="d-flex align-items-center">
                                        <input type="checkbox" name="remove_instagram_image" value="1">
                                        <span class="ml-2">Remove Instagram image</span>
                                    </label>
                                </div>
                            @endif
                            @error('instagram_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
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
                                                <label class="custom-control-label" for="isShow_{{ $key }}">Show by default</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-remove-size">Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @foreach($product->sizes as $key => $size)
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <select name="sizes[{{ $key }}][display_size_id]" class="form-control">
                                                <option value="">Select Size</option>
                                                @foreach($d_sizes as $d_size)
                                                    <option value="{{ $d_size->id }}" {{ $size->display_size_id == $d_size->id ? 'selected' : '' }}>
                                                        {{ $d_size->size }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="sizes[{{ $key }}][price]"
                                                   value="{{ $size->price }}"
                                                   class="form-control price-input"
                                                   placeholder="Price" step="0.01">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="sizes[{{ $key }}][discount]"
                                                   value="{{ $size->discount }}"
                                                   class="form-control discount-input"
                                                   placeholder="Discount" step="0.01">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="sizes[{{ $key }}][final_price]"
                                                   value="{{ $size->final_price }}"
                                                   class="form-control final-price"
                                                   placeholder="Final Price" step="0.01" readonly>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       name="sizes[{{ $key }}][is_show]"
                                                       id="isShow_{{ $key }}"
                                                       value="1"
                                                       {{ $size->is_show ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="isShow_{{ $key }}">Show by default</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-remove-size">Remove</button>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <button type="button" class="btn btn-primary" id="add-size">Add Size</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-form-label">Product Colors <span class="text-danger">*</span></label>
                    <div class="color-container">
                        <select name="colors[]" class="form-control select2" multiple="multiple">
                            <option value="">Select Colors</option>
                            @foreach($colors as $color)
                                <option value="{{ $color->id }}"
                                    @selected($product->colors->contains('color_id', $color->id))>
                                    {{ $color->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('colors')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote-lite.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <style>
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
@endpush
@push('scripts')
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script src="{{ asset('backend/summernote/summernote-lite.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#lfm').filemanager('image');

        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150,
            });

            $('.select2').select2();

            $('#description').summernote({
                placeholder: "Write detail description.....",
                tabsize: 2,
                height: 200
            });

            let show = false;
            $('#upcomming_toggler').on('click', function() {
                $('#div_lunch_date').toggle();
                //  show = true;

            });

            $('#isOfferToggler').on('click', function() {
                $('#div_product_offer').toggle();
                //  show = true;

            });

            $('#price').on('keyup change', function() {
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
                console.log(price, discount, final_price);

                $('#final_price').val(final_price);
                // $('#final_price_div').show();
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

                            $('#child_cat_id').html(html_option);
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
                    $('#new_photo_show').html(images_div);
                }
            });

            //bottle image show
            $('#bottle_image').on('change', function(event) {
                let previews = [];
                let img = [];
                let images_div = '';
                console.log(event.target.files);
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
                            bottleImageShow();
                        }
                        // console.log(images_div);
                    }
                    reader.readAsDataURL(file);

                }

                function bottleImageShow() {
                    $('#new_bottle_image_show').html(images_div);
                }
            });

            let sizeIndex = $('#size-rows .row').length - 1;

            // Calculate final price
            $(document).on('input', '.price-input, .discount-input', function() {
                let row = $(this).closest('.row');
                let price = parseFloat(row.find('.price-input').val()) || 0;
                let discount = parseFloat(row.find('.discount-input').val()) || 0;
                let finalPrice = price - discount;
                row.find('.final-price').val(finalPrice >= 0 ? finalPrice : 0);
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
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="sizes[${sizeIndex}][price]" class="form-control price-input"
                                   placeholder="Price" step="0.01">
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
                                <label class="custom-control-label" for="isShow_${sizeIndex}">Show by default</label>
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

        function removePhoto(button) {
            const photoDiv = $(button).closest('.position-relative');
            const photoUrl = photoDiv.find('input[name="remaining_photos[]"]').val();

            // Add to removed_photos array
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'removed_photos[]';
            input.value = photoUrl;
            document.querySelector('form').appendChild(input);
            console.log(input);
            photoDiv.remove();
        }

        function removeBottleImage(button) {
            const bottleImageDiv = $(button).closest('.position-relative');
            const bottleImageUrl = bottleImageDiv.find('input[name="remaining_bottle_images[]"]').val();

            // Add to removed_bottle_images array
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'removed_bottle_images[]';
            input.value = bottleImageUrl;
            document.querySelector('form').appendChild(input);
            console.log(input);
            bottleImageDiv.remove();
        }

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
            }
        }
    </script>
@endpush
