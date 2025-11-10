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

        // prevent duplicate requests
        if (AdminRequest::where('user_id', $user->id)->exists()) {
            session()->flash('msg', '⚠️ You already have a pending or processed request.');
            return;
        }

        AdminRequest::create([
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        session()->flash('msg', '💚 Request sent successfully, awaiting admin approval.');
    }

    public function render()
    {
        auth()->shouldUse('web');
        $user = Auth::user();
        $request = AdminRequest::where('user_id', $user->id)->first();

        return view('livewire.user.documents', [
            'request' => $request,
        ]);
    }
}
