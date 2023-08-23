<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostUpdate extends Component
{
    use WithFileUploads;

    public $post;
    public $confirmingPostDeletion = false;
    public $imagePreview = false;
    public $title;
    public $content;
    public $imageSource;
    public $imageUrl;
    public $imageUpload;
    public $imagePathCurrent;

    protected function rules()
    {
        $rules = [
            'title' => 'required|unique:posts,title,' . $this->post->id,
            'content' => ['required'],
            'imageSource' => 'required|in:url,upload'
        ];

        if ($this->imageSource == 'url') {
            $rules['imageUrl'] = 'required_if:imageSource,url|url';
        } elseif ($this->imageSource == 'upload' && !$this->imagePathCurrent) {
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

    public function mount(Post $post)
    {
        $this->post = $post;

        $this->title = $post->title;
        $this->content = $post->content;
        $this->imageSource = $post->featured_image['source'];
        $this->imageUpload = null;

        if ($this->imageSource == 'url') {
            $this->imageUrl = $post->featured_image['path'];
        } else if ($this->imageSource == 'upload') {
            $this->imagePathCurrent = $post->featured_image['path'];
        }
    }

    public function render()
    {
        return view('livewire.posts.post-update');
    }

    public function submit()
    {
        $this->validate();

        $path = null;

        if ($this->imageSource == 'url') {
            $path = $this->imageUrl;
        } else if ($this->imageUpload) {
            $path = $this->imageUpload->store('posts', 'public');
        } else {
            $path = $this->imagePathCurrent;
        }

        $this->post->title = $this->title;
        $this->post->content = $this->content;
        $this->post->featured_image = [
            'source' => $this->imageSource,
            'path' => $path
        ];

        $this->post->update();

        session()->flash('success', 'Post updated');
        
        $this->mount($this->post);
    }

    public function deletePost()
    {
        $this->post->delete();

        return redirect()->to('/posts');
    }
}
