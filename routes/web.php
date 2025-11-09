<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ⚙️ Settings (Volt)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// ⚙️ Admin Panel Routes (Livewire)
Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/admin/requests', \App\Livewire\Admin\Requests::class)
        ->name('admin.requests');
});

// Auth routes
require __DIR__ . '/auth.php';
