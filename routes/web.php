<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\animalController;
use App\Http\Controllers\rescuerController;
use App\Http\Controllers\personnelController;
use App\Http\Controllers\diseaseInjuryController;
use App\Http\Controllers\adopterController;
use App\Http\Controllers\contactController;

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

Route::resource("/personnel", "personnelController")->middleware("auth");
Route::get("/personnel/restore/{id}", [
    "uses" => "personnelController@restore",
    "as" => "personnel.restore",
])->middleware("auth");
Route::get("/personnel/forceDelete/{id}", [
    "uses" => "personnelController@forceDelete",
    "as" => "personnel.forceDelete",
])->middleware("auth");

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/homewelcome', function () {
    return view('homewelcome');
});

Route::get("/search", [animalController::class, "search"])->name("search");
Route::get("/result", [animalController::class, "result"])->name("result");

// Route::resource("/rescuer", "rescuerController")->middleware("auth");
Route::resource("/rescuer", rescuerController::class)->middleware("auth");
Route::get("/rescuer/restore/{id}", [
    "uses" => "rescuerController@restore",
    "as" => "rescuer.restore",
]);
Route::get("/rescuer/forceDelete/{id}", [
    "uses" => "rescuerController@forceDelete",
    "as" => "rescuer.forceDelete",
]);

Route::get("/diseaseinjury/restore/{id}", [
    "uses" => "diseaseInjuryController@restore",
    "as" => "diseaseinjury.restore",
]);
Route::get("/diseaseinjury/forceDelete/{id}", [
    "uses" => "diseaseInjuryController@forceDelete",
    "as" => "diseaseinjury.forceDelete",
]);


Route::resource("/diseaseinjury", diseaseInjuryController::class)->middleware(
    "auth"
);


Route::resource("/adopter", adopterController::class)->middleware("auth");
Route::get("/adopter/restore/{id}", [
    "uses" => "adopterController@restore",
    "as" => "adopter.restore",
]);
Route::get("/adopter/forceDelete/{id}", [
    "uses" => "adopterController@forceDelete",
    "as" => "adopter.forceDelete",
]);


Route::resource("/animals", "animalController")->middleware("auth");
Route::get("/animals/restore/{id}", [
    "uses" => "animalController@restore",
    "as" => "animals.restore",
]);
Route::get("/animals/forceDelete/{id}", [
    "uses" => "animalController@forceDelete",
    "as" => "animals.forceDelete",
]);

Route::get("/search", [animalController::class, "search"])->name("search");
Route::get("/result", [animalController::class, "result"])->name("result");

// Route::get("/login", [personnelController::class, "login"]);
// Route::post("/check", [personnelController::class, "check"])->name("check");
// Route::get("/welcome", [personnelController::class, "welcome"]);
// Route::get("/logout", [personnelController::class, "logout"]);
// Route::get("/personnel/create", [personnelController::class,"create"]);

Route::get('/', function () {
    return view('home');
});


Route::get('/', function () {
    return view('homepage');
});
 
 

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
