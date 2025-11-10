<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\AdminRequest;
use App\Models\User;

class Requests extends Component
{
    // متغیر اصلی برای درخواست‌های ادمین شدن
    public $requests;

    // متغیر جدید برای لیست کامل کاربران و نقش‌هایشان
    public $allUsers;

    // Approve and Assign Role
    public function approve($id)
    {
        $req = AdminRequest::findOrFail($id);
        $req->update(['status' => 'approved']);

        $user = User::find($req->user_id);
        if ($user && !$user->hasRole('admin')) {
            // remove previous roles (safety)
            $user->syncRoles([]);
            $user->assignRole('admin');
        }

        session()->flash('msg', '✅ Request approved successfully 💚');
        $this->loadRequests();
        $this->loadAllUsers(); // رفرش لیست کاربران بعد از تایید
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
        $this->loadAllUsers();
    }

    public function loadRequests()
    {
        // کوئری برای درخواست‌های ادمین شدن (همانطور که قبلاً داشتی)
        $this->requests = AdminRequest::with('user')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function loadAllUsers()
    {
        // کوئری جدید برای لیست کل کاربران و نقش‌هاشون
        $this->allUsers = User::with('roles')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function render()
    {
        auth()->shouldUse('web');

        return view('livewire.admin.requests')
            ->layout('layouts.app');
    }
}
