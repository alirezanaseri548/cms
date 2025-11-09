<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\AdminRequest;
use App\Models\User;

class Requests extends Component
{
    // Approve and Assign Role
    public function approve($id)
    {
        $req = AdminRequest::findOrFail($id);
        $req->update(['status' => 'approved']);

        $user = User::find($req->user_id);
        if ($user) {
            $user->assignRole('admin');
        }

        session()->flash('msg', '✅ Request approved successfully 💚');
    }

    // Reject Request
    public function reject($id)
    {
        $req = AdminRequest::findOrFail($id);
        $req->update(['status' => 'rejected']);

        session()->flash('msg', '❌ Request rejected.');
    }

    public function render()
    {
        $requests = AdminRequest::with('user')->get();
        return view('livewire.admin.requests', compact('requests'));
    }
}
