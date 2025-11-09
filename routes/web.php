<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\User\Documents;
use App\Livewire\Admin\Requests;

// 🏠 Homepage
Route::get('/', function () {
    return view('welcome');
})->name('home');

// 💼 Dashboard for logged-in users
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ⚙️ Settings Routes (Volt Components)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// 👤 User Routes (Livewire)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/documents', Documents::class)->name('user.documents');
});

// 🛠️ Admin Panel Routes (Livewire)
Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/admin/requests', Requests::class)->name('admin.requests');
});

// 🔐 Authentication Routes
require __DIR__ . '/auth.php';
