<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\User\Documents;
use App\Livewire\Admin\Requests;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/user/documents', Documents::class)
        ->middleware('role:user')
        ->name('user.documents');

    Route::get('/admin/requests', Requests::class)
->middleware('role:admin|super-admin')
        ->name('admin.requests');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/super-admin/users', \App\Livewire\SuperAdmin\Users::class)
    ->middleware('role:super-admin')
    ->name('super-admin.users');

require __DIR__ . '/auth.php';
