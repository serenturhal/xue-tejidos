<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public $open = false;
    public $title;
    public $content;

    public function render()
    {
        return view('livewire.create-post');
    }

    public function save()
    {
        $this->validate([
            'title' => 'required|max:10',
            'content' => 'required|min:30',
        ]);

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->resetForm();
        $this->emitTo('show-posts', 'showInTable'); // usando emitTo logro que solo sea el componente showPosts el que escuche el evento
        $this->emit('alert', 'Se ha creado el post');
    }

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    private function resetForm()
    {
        $this->open = false;
        $this->title = '';
        $this->content = '';
    }
}