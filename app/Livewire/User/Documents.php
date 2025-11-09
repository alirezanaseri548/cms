<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\AdminRequest;
use Illuminate\Support\Facades\Auth;

class Documents extends Component
{
    public function sendRequest()
    {
        $user = Auth::user();

        // اگر قبلاً درخواست داده، چیزی انجام نده
        if (AdminRequest::where('user_id', $user->id)->exists()) {
            return;
        }

        AdminRequest::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);
    }

    public function render()
    {
        $user = Auth::user();
        $request = AdminRequest::where('user_id', $user->id)->first();

        return view('livewire.user.documents', [
            'request' => $request,
        ]);
    }
}
