<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostCreate extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $featured_image = [
        'source' => 'url',
        'path' => ''
    ];

    protected $rules = [
        'title' => ['required', 'unique:posts,title'],
        'content' => ['required'],
        'featured_image.path' => ['required']
    ];

    protected $messages = [
        'featured_image.path.required' => 'The featured image URL field is required.'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        Post::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'featured_image' => $this->featured_image
        ]);

        session()->flash('success', 'Post created');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.posts.post-create');
    }
}
