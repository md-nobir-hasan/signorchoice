<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:products,title,' . $this->product->id,
            'description' => 'nullable|string',
            'summary' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',
            'is_featured' => 'boolean',
            'stock' => 'required|integer|min:0',
            'photo' => 'nullable|array',
            'photo.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'serial' => 'required|integer',
            'status' => ['required', Rule::in(['active', 'inactive'])],

            // Product sizes validation
            'sizes' => 'required|array|min:1',
            'sizes.*.display_size_id' => 'required|exists:display_sizes,id',
            'sizes.*.price' => 'required|numeric|min:0',
            'sizes.*.discount' => 'nullable|numeric|min:0',
            'sizes.*.final_price' => 'required|numeric|min:0',
            'sizes.*.is_show' => 'nullable|boolean',

            // Required attributes
            'colors' => 'required|array|min:1',
            'colors.*' => 'exists:colors,id',

            'instragram_link' => 'nullable|url|max:500',

            // Image validation rules with expanded formats
            'banner_image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,gif,webp,svg,bmp,tiff,avif',
                'max:2048',
                // 'dimensions:min_width=1920,min_height=500'
            ],
            'product_thumbnail_image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,gif,webp,svg,bmp,tiff,avif',
                'max:2048',
                // 'dimensions:min_width=400,min_height=400'
            ],
            'best_collection_image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,gif,webp,svg,bmp,tiff,avif',
                'max:2048',
                // 'dimensions:min_width=800,min_height=600'
            ],
            'collection_arrived_image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,gif,webp,svg,bmp,tiff,avif',
                'max:2048',
                // 'dimensions:min_width=800,min_height=600'
            ],
            'instagram_image' => [
                'nullable',
                'image',
                'mimes:jpeg,jpg,png,gif,webp,svg,bmp,tiff,avif',
                'max:2048',
                // 'dimensions:min_width=800,min_height=800'
            ],

            // Image removal flags
            'remove_banner_image' => 'nullable|boolean',
            'remove_product_thumbnail_image' => 'nullable|boolean',
            'remove_best_collection_image' => 'nullable|boolean',
            'remove_collection_arrived_image' => 'nullable|boolean',
            'remove_instagram_image' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Product title is required',
            'slug.required' => 'Product slug is required',
            'slug.unique' => 'This slug has already been taken',
            'serial.required' => 'Product serial is required',
            'status.required' => 'Product status is required',
            'sizes.required' => 'At least one size is required',
            'sizes.*.display_size_id.required' => 'Size selection is required',
            'sizes.*.price.required' => 'Price is required for each size',
            'sizes.*.final_price.required' => 'Final price is required for each size',
            'colors.required' => 'Please select at least one color',
            'colors.*.exists' => 'Selected color is invalid',

            'instragram_link.url' => 'Invalid Instagram link',
            'instragram_link.max' => 'Instagram link must be less than 500 characters',
        ];
    }
}
