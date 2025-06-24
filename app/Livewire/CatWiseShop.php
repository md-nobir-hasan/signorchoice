<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Category;
use App\Models\DisplaySize;
use App\Models\DisplayType;
use App\Models\Graphic;
use App\Models\hdd;
use App\Models\ProcessorGeneration;
use App\Models\ProcessorModel;
use App\Models\Product;
use App\Models\Ram;
use App\Models\SpecialFeature;
use App\Models\ssd;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Products of Certain Category')]

class CatWiseShop extends Component
{
    public $cat;
    public $subcat;
    public $prds = null;
    // public $slug_wise_product;
    // public function mount(){
    //     $this->slug_wise_product = Product::where('cat_id',$cat->id)->orderBy('id','desc')->paginate(20)->where('status','active')->orderBy('id','desc')->paginate(20);
    // }
    public function render()
    {
        // url set to cache for login
        session(['login_previous_url' => request()->url()]);

        $per_page = request()->per_page ?? 20;
        $sort_by = request()->sort_by ?? 'newest';

        // Get base query
        $query = Product::with(['sizes', 'sizes.size', 'cat_info', 'sub_cat_info', 'brand'])
                        ->where('status', 'active');

        // Apply category filters
        if ($this->subcat) {
            $subcat = Category::where('slug', $this->subcat)->first();
            $query->where('child_cat_id', $subcat->id);
        } else {
            $cat = Category::where('slug', $this->cat)->first();
            $query->where('cat_id', $cat->id);
        }

        // Apply sorting
        switch ($sort_by) {
            case 'price_asc':
                $query->orderBy('final_price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('final_price', 'desc');
                break;
            case 'popularity':
                $query->orderBy('views', 'desc');
                break;
            case 'average_rating':
                $query->orderBy('average_rating', 'desc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        // Get filter options
        $n['products'] = $query->paginate($per_page);
        $n['brands'] = Brand::get();
        $n['d_sizes'] = DisplaySize::get();

        return view('livewire.shop', $n);
    }
}
