<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\HpDetail\HpDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/purchase-form', function() {
    return view('purchase-form');
})->middleware(['auth', 'verified'])->name('purchase-form');

Route::get('/selling-form', function() {
    return view('selling-form');
})->middleware(['auth', 'verified'])->name('selling-form');

Route::get('/transaction-form', function() {
    return view('transaction');
})->middleware(['auth', 'verified'])->name('transaction-form');


Route::get('/hp/{id}', function ($id) {
    return view('detail', [
        'hpId' => $id
    ]);
});

Route::get('/employee/dashboard', function () {
    return view('employee');
})->name('employee');


Route::get('/speed-test', function () {
    return 'OK';
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
