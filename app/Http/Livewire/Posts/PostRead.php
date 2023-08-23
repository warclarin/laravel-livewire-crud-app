<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class PostRead extends Component
{
    public $post;
    public $previousPost;
    public $nextPost;
    public $showFeaturedImage = false;

    public function mount($slug)
    {
        $this->post = Post::where('slug', $slug)->first();
        abort_if(!$this->post, 404);

        $this->previousPost = Post::where('id', '<', $this->post->id)->orderBy('id', 'desc')->first();
        $this->nextPost = Post::where('id', '>', $this->post->id)->first();
    }

    public function render()
    {
        return view('livewire.posts.post-read');
    }
}
