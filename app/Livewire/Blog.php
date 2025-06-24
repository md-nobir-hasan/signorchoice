<?php

namespace App\Livewire;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Blogs')]

class Blog extends Component
{
    public $currentIndex = 0;
    public $blogs;
    public $relatedBlogs;
    public $default_blog;
    public $popularBlogs;

    public function mount($slug = null)
    {
        if($slug){
            $default_blog = Post::where('slug',$slug)->first();
            $default_blog->view_count++;
            $default_blog->save();
            $this->default_blog = $default_blog;
        }else{
            $this->default_blog = Post::where('is_default',1)->first();
        }

        // url set to cache for login
        session(['login_previous_url' => request()->url()]);

        //related blogs
        $this->relatedBlogs = Post::where('status', 'active')
                        ->where('post_cat_id', $this->default_blog?->post_cat_id)
                        ->where('id', '!=', $this->default_blog?->id)
                        ->limit(15)
                        ->get();

        //popular blogs
        $this->popularBlogs = Post::where('status', 'active')
                        ->where('id', '!=', $this->default_blog?->id)
                        ->orderBy('view_count', 'desc')
                        ->limit(10)
                        ->get();

    }

    public function previousBlog()
    {
        if($this->currentIndex > 0) {
            $this->currentIndex--;
        }
    }

    public function nextBlog()
    {
        if($this->currentIndex < count($this->relatedBlogs) - 1) {
            $this->currentIndex++;
        }
    }

    public function render()
    {
        $n['categories'] = PostCategory::where('status','active')
                            ->get();

        return view('livewire.blog',$n);
    }
}
