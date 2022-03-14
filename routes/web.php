<?php

use Illuminate\Support\Facades\Route;

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

Route::resource("/personnel", "personnelController");
Route::get("/personnel/restore/{id}", [
    "uses" => "personnelController@restore",
    "as" => "personnel.restore",
]);
Route::get("/personnel/forceDelete/{id}", [
    "uses" => "personnelController@forceDelete",
    "as" => "personnel.forceDelete",
]);

Route::get('/dashboard', function () {
    return view('dashboard');
});

// Route::get("/login", [personnelController::class, "login"]);
// Route::post("/check", [personnelController::class, "check"])->name("check");
// Route::get("/welcome", [personnelController::class, "welcome"]);
// Route::get("/logout", [personnelController::class, "logout"]);
// Route::get("/personnel/create", [personnelController::class,"create"]);

Route::get('/', function () {
    return view('home');
});
    