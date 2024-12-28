<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');
// Route::get('/event', function () {
//     return view('admin.events');
// })->name('admin.event');
// Route::get('/member', function(){
//     return view('admin.members');
// })->name('admin.member');

Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::post('/', [EventController::class, 'store'])->name('store');
    Route::get('{event}/edit', [EventController::class, 'edit'])->name('edit');
    Route::put('{event}/update', [EventController::class, 'update'])->name('update');
    Route::delete('{event}', [EventController::class, 'destroy'])->name('destroy');
});


Route::prefix('member')->name('members.')->group(function () {
    Route::get('/', [MemberController::class, 'index'])->name('index'); // members.index
    Route::get('/search', [MemberController::class, 'search'])->name('search'); // members.search
    Route::post('/', [MemberController::class, 'store'])->name('store'); // members.store
    Route::get('/{member}/edit', [MemberController::class, 'edit'])->name('edit'); // members.edit
    Route::put('/{member}/update', [MemberController::class, 'update'])->name('update'); // members.update
    Route::delete('/{member}', [MemberController::class, 'destroy'])->name('destroy'); // members.destroy
});



Route::get('/registration', [MemberController::class, 'create'])->name('member.create');
Route::post('/registration', [MemberController::class, 'store'])->name('member.store');

Route::get('/members', [MemberController::class, 'index'])->name('member.index');

Route::get('/class', [ClassesController::class, 'index'])->name('class.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
//     Route::get('/events', [EventController::class, 'index'])->name('events.index');
//     Route::post('/events', [EventController::class, 'store'])->name('events.store');
//     Route::put('/events/{event}/update', [EventController::class, 'update'])->name('events.update');
//     Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
// });

require __DIR__.'/auth.php';
