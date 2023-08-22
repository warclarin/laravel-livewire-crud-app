<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class PostUpdate extends Component
{
    public $post;
    public $confirmingPostDeletion = false;

    protected function rules()
    {
        return [
            'post.title' => 'required|unique:posts,title,' . $this->post->id,
            'post.content' => ['required'],
            'post.featured_image.path' => ['required']
        ]; 
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    
    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.posts.post-update');
    }

    public function submit()
    {
        $this->post->update();

        session()->flash('success', 'Post updated');
    }

    public function deletePost()
    {
        $this->post->delete();

        return redirect()->to('/posts');
    }
}
