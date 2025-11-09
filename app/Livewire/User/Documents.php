<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\AdminRequest;
use Illuminate\Support\Facades\Auth;

class Documents extends Component
{
    public $alreadyRequested = false;
    public $isAdmin = false;

    public function mount()
    {
        $user = Auth::user();

        // چک کن که کاربر قبلاً درخواست داده یا نه
        $this->alreadyRequested = AdminRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->exists();

        // چک کن که کاربر الان نقش ادمین داره یا نه
        $this->isAdmin = $user->hasRole('admin');
    }

    public function sendRequest()
    {
        $user = Auth::user();

        // جلوگیری از ریکوئست تکراری
        if ($this->alreadyRequested || $this->isAdmin) {
            session()->flash('message', 'Request already sent or you are already an admin.');
            return;
        }

        AdminRequest::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $this->alreadyRequested = true;
        session()->flash('message', 'Your request has been sent successfully 💚');
    }

    public function render()
    {
        return view('livewire.user.documents');
    }
}
