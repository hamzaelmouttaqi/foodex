<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Message extends Component
{
    protected $listeners =['get_message' =>'render'];
    public function render()
    {
        session()->flash('message', 'order successfully traited.');
        return view('livewire.message');
    }
}
