<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Stock extends Component
{
    public $jmlPosting = 12;

    public function tambah(){
        $this->jmlPosting += 5;
    }

    public function kurang(){
        $this->jmlPosting -= 3;
    }

    public function render()
    {
        return view('livewire.stock');
    }
}
