<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class Posts extends Component
{
    public $posts, $judul, $content, $post_id;
    public $isOpen = 0;

    public function render()
    {
        $this->posts = Post::all();
        return view('livewire.posts');
    }

    public function create()
    {
        $this->resetInput();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function resetInput(){
        $this->judul = '';
        $this->content = '';
        $this->post_id = '';
    }

    public function store(){
        $this->validate([
            'judul' => 'required',
            'content' => 'required',
        ]);
   
        Post::updateOrCreate(['id' => $this->post_id], [
            'judul' => $this->judul,
            'content' => $this->content
        ]);
  
        session()->flash('message', 
            $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');
  
        $this->closeModal();
        $this->resetInput();
    }

    public function edit($id){
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->judul = $post->judul;
        $this->content = $post->content;

        $this->openModal();
    }

    public function delete($id){
        Post::find($id)->delete();
        session()->flash('message', 'Post dengan id: '.$id.' berhasil dihapus');
    }
}
