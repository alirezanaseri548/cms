<?php

namespace App\Livewire\User;

use Livewire\Component;

class Dashboard extends Component
{
    public function goToDocuments()
    {
        return redirect()->to('/documents');
    }

    public function render()
    {
        return view('livewire.user.dashboard');
    }
}
