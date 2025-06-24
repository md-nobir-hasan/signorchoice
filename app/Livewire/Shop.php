<?php

namespace App\Livewire;

// use Livewire\WithPagination;

use App\Models\Brand;
use App\Models\DisplaySize;
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
#[Title('Shop')]
class Shop extends Component
{
    public $prds;
    public $cat;
    public $subcat;
    public function mount(){
        $this->prds = Product::where('status', 'active')
                        ->where('is_showable_to_user',1)
                        ->get();

        // url set to cache for login
        session(['login_previous_url' => request()->url()]);
    }
    public function render()
    {
        $per_page = request()->per_page ?? 8;
        $sort_by = request()->sort_by ?? 'price_asc';

        $query = Product::with(['product_sizes' => function($q) {
            $q->where('is_show', true);
        }])
        ->whereHas('product_sizes', function($q) {
            $q->where('is_show', true);
        })
        ->where('status', 'active')
        ->where('is_showable_to_user', 1);

        switch ($sort_by) {
            case 'price_asc':
                $query->join('product_sizes', 'products.id', '=', 'product_sizes.product_id')
                    ->where('product_sizes.is_show', true)
                    ->select('products.*')
                    ->selectRaw('MIN(product_sizes.final_price) as min_price')
                    ->orderBy('min_price', 'asc')
                    ->groupBy('products.id');
                break;
            case 'price_desc':
                $query->join('product_sizes', 'products.id', '=', 'product_sizes.product_id')
                    ->where('product_sizes.is_show', true)
                    ->select('products.*')
                    ->selectRaw('MIN(product_sizes.final_price) as min_price')
                    ->orderBy('min_price', 'desc')
                    ->groupBy('products.id');
                break;
            case 'popularity':
                $query->orderBy('views', 'desc');
                break;
            case 'average_rating':
                $query->orderBy('average_rating', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
        }

        $n['products'] = $query->paginate($per_page);
        $n['brands'] = Brand::get();
        $n['p_models'] = ProcessorModel::get();
        $n['p_generations'] = ProcessorGeneration::get();
        $n['d_sizes'] = DisplaySize::get();
        $n['rams'] = Ram::get();
        $n['ssds'] = ssd::get();
        $n['hdds'] = hdd::get();
        $n['graphics'] = Graphic::get();
        $n['s_features'] = SpecialFeature::get();
        return view('livewire.shop',$n);
    }
}
