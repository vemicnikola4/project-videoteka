<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\People;
class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //colection??
        //query builder??
        $genres = Genre::all()->sortBy('name');
        //compact od podataka pravi asoc niz/Naziv promenjive i kljucmoraju biti identicni.
        //view automatski se pozicionira na ressources/views i onda dalje putanja u ovom slucaju film.create

        $people = People::all()->sortBy('fullName');

        return view('film.create',compact('genres','people'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //1.Validacije podataka
        $request->validate([
            'name' => 'required',            
            'running_h' => 'nullable|numeric|min:1|integer',
            'running_m' => 'nullable|numeric|between:1,59|integer',
            'year' => 'required|date_format:Y|before_or_equal:today',
            'rating' => 'required|decimal:1|between:1,10',
            'directors' => 'required|array',
            'writers' => 'required|array',
            'stars' => 'required|array',
            'genres' => 'required|array',
            'image' => 'image|between:1,2048'
        ]);

        //Film::create napravi novi objekat klase film i popunired u tabeli i vrati te podatke i stavi ih u ovu promenjivu
        //upis u tabelu film
        //2. upis u tabelu Film
        $film = Film::create($request->only('name','running_h','running_m','year','rating'));
        //3. upis u tabelu film_genre
        $film->genres()->attach($request->genres);
        //4. upis u tabelu film_director, film_writer, film_star
        $film->directors()->attach($request->directors);
        $film->writers()->attach($request->writers);
        $film->stars()->attach($request->stars);
            
        return redirect()->route('film.show', ['film' => $film]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        return view('film.show',['film'=>$film]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        //
    }
}
