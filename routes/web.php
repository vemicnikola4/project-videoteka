<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\App;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\FilmController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/lang/{locale}', function (string $locale) {
    //App::setLocale($locale);
    session(['locale' => $locale]);

    //povratak na prethodnu stranicu
    return redirect()->back();
})->whereIn('locale', ['en', 'sr'])->name('lang');

Route::get('/',function() {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    

    //***PEOPLE */
    //prikaz svih podataka
    Route::get('/people', [PeopleController::class, 'index'])
    ->name('people.index');

    //prikaz forme za unos new row in people
    Route::get('/people/create',[PeopleController::class,'create'])->name('people.create');


    //validacija podataka i upis novog reda u tabelu
    Route::post('/people',[PeopleController::class,'store'])->name('people.store');

    //forma za izmenu podataka
    Route::get('/people/{people}/edit',[PeopleController::class,'edit'])->name('people.edit');

    //izmena postojećeg podatka
    Route::put('/people/{people}', [PeopleController::class, 'update'])
    ->name('people.update');

    Route::get('/people/order',[PeopleController::class,'index'])->name('people.order');
    
    //Brisanje Podataka
    Route::delete('/people/{people}',[PeopleController::class,'destroy'])->name('people.destroy');

    //ruta za prikaz detalja o osobi
     Route::get('/people/{people}', [PeopleController::class, 'show'])
     ->name('people.show');


    //***GENRE */

    //prikaz svih podataka
    Route::get('/genre', [GenreController::class, 'index'])
    ->name('genre.index');

    //create new genre, prikaz forme za unos
    Route::get('/genre/create',[GenreController::class,'create'])->name('genre.create');

    //validacija podataka i upis novog reda u tabelu
    Route::post('/genre',[GenreController::class,'store'])->name('genre.store');

    //forma za izmenu podataka
    Route::get('/genre/{genre}/edit',[GenreController::class,'edit'])->name('genre.edit');

    //izmena postojećeg podatka
    Route::put('/genre/{genre}', [GenreController::class, 'update'])
    ->name('genre.update');

    //Brisanje Podataka
    //Neophodno je da delete dugmem bude uokviren jednom formom
    Route::delete('/genre/{genre}',[GenreController::class,'destroy'])->name('genre.destroy');

    //ruta za prikaz detalja o filmu
    // Route::get('/film/{film}', [FilmController::class, 'show'])
    // ->name('film.show');

    //Definisanje svih 7 ruta za kontroler
    Route::resource('film', FilmController::class);

});

require __DIR__.'/auth.php';

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
