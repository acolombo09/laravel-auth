<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProjectController as GuestProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('guests.welcome');
});

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Raggruppo le rotte rendendole disponibili solo per utenti loggati
Route::middleware(['auth', 'verified'])
    ->prefix("admin") // così posso rimuovere /admin da ogni rotta
    ->name("admin.") // idem per il name di ogni rotta
    // il group sempre per ultimo
    ->group(function () {
    
// CREATE
    Route::get("/projects/create", [ProjectController::class, "create"])->name("projects.create");
    Route::post("/projects", [ProjectController::class, "store"])->name("projects.store");

// READ
    Route::get("/projects", [ProjectController::class, "index"])->name("projects.index");
    Route::get("/projects/{project}", [ProjectController::class, "show"])->name("projects.show");
});

// chiamato guestpostcontroller perchè nel controller si è aggiunto "as GuestPostController"
// per far sì che i nomi tra admin e guests non vengano confusi
Route::get("/projects", [GuestProjectController::class, "index"])->name("projects.index");

Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::delete('/admin/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');
});

require __DIR__.'/auth.php';
