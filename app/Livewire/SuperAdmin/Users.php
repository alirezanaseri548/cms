<?php

namespace App\Livewire\SuperAdmin;

use Livewire\Component;
use App\Models\User;
use App\Models\AdminRequest;

class Users extends Component
{
    public $users, $requests;

    public function mount()
    {
        auth()->shouldUse('web');
        $this->loadData();
    }

    public function loadData()
    {
        $this->users = User::with('roles')->orderBy('created_at', 'desc')->get();
        $this->requests = AdminRequest::with('user')->orderBy('created_at','desc')->get();
    }

    public function approveRequest($requestId)
    {
        $req = AdminRequest::find($requestId);
        if (!$req) return;

        $user = User::find($req->user_id);
        if ($user && !$user->hasRole('admin')) {
            $user->syncRoles([]);
            $user->assignRole('admin');
            $req->status = 'approved';
            $req->save();
            session()->flash('msg', '✅ Request approved; user promoted to admin.');
        }

        $this->loadData();
    }

    public function rejectRequest($requestId)
    {
        $req = AdminRequest::find($requestId);
        if ($req) {
            $req->status = 'rejected';
            $req->save();
            session()->flash('msg', '❌ Request rejected.');
        }
        $this->loadData();
    }

    public function setRoleManually($userId, $roleName)
    {
        $validRoles = ['user','admin','super-admin'];
        $user = User::find($userId);
        if (!$user || !in_array($roleName, $validRoles)) return;

        $user->syncRoles([]);
        $user->assignRole($roleName);

        session()->flash('msg', '💚 Role changed successfully.');
        $this->loadData();
    }

    public function render()
    {
        auth()->shouldUse('web');
        return view('livewire.super-admin.users');
    }
}
