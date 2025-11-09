<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\AdminRequest;

class Documents extends Component
{
    use WithFileUploads;

    public $docs;
    public $statusMessage;

    public function upload()
    {
        $path = $this->docs->store('documents','public');
        AdminRequest::create(['user_id' => auth()->id()]);
        $this->statusMessage = 'Your request has been sent successfully 💚';
    }

    public function render()
    {
        return view('livewire.user.documents');
    }
}
