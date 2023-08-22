<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostTable extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.posts.post-table', [
            'posts' => Post::orderBy('id', 'desc')->paginate(5)
        ]);
    }
}
