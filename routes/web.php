<?php

use App\Models\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

Route::get("/contacts/create",  [ContactController::class, 'create'])->name("contacts.create");

Route::get("/contacts/{id}",  [ContactController::class, 'show'])->name("contacts.show");
Route::post("/contacts/create", [ContactController::class, 'store'])->name('contacts.store');
Route::get("/contacts/edit/{contact}", [ContactController::class, 'edit'])->name('contacts.edit');
Route::put("/contacts/edit", [ContactController::class, 'update'])->name('contacts.update');
