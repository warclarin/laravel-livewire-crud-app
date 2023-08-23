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
    public $imagePreview = false;
    public $imageSource = 'upload';
    public $imageUrl;
    public $imageUpload;

    protected function rules()
    {
        $rules = [
            'title' => ['required', 'unique:posts,title'],
            'content' => ['required'],
            'imageSource' => 'required|in:url,upload'
        ];

        if ($this->imageSource == 'url') {
            $rules['imageUrl'] = 'required_if:imageSource,url|url';
        } elseif ($this->imageSource == 'upload') {
            $rules['imageUpload'] = 'required_if:imageSource,upload|image|max:1024';
        }

        return $rules;
    }

    public function updated($propertyName)
    {
        if ($propertyName == 'imageSource') {
            if ($this->imageSource == 'url') {
                $this->reset('imageUpload');
            } elseif ($this->imageSource == 'upload') {
                $this->reset('imageUrl');
            }
        }

        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        $path = null;

        if ($this->imageSource == 'url') {
            $path = $this->imageUrl;
        } else {
            $path = $this->imageUpload->store('posts', 'public');
        }

        $post = Post::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'featured_image' => [
                'source' => $this->imageSource,
                'path' => $path
            ]
        ]);

        session()->flash('success', 'Post created');
        session()->flash('slug', $post->slug);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.posts.post-create');
    }
}
