<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\AdminRequest;
use App\Models\User;

class Requests extends Component
{
    public $requests;

    // Approve and Assign Role
    public function approve($id)
    {
        $req = AdminRequest::findOrFail($id);
        $req->update(['status' => 'approved']);

        $user = User::find($req->user_id);
        if ($user && !$user->hasRole('admin')) {
            $user->assignRole('admin');
        }

        session()->flash('msg', '✅ Request approved successfully 💚');
        $this->loadRequests();
    }

    // Reject Request
    public function reject($id)
    {
        $req = AdminRequest::findOrFail($id);
        $req->update(['status' => 'rejected']);

        session()->flash('msg', '❌ Request rejected.');
        $this->loadRequests();
    }

    public function mount()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        $this->requests = AdminRequest::with('user')->orderBy('created_at', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.admin.requests');
    }
}
