<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\App;
use Exeption;
class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     * //index je zaprikaz svih podataka
     */
    public function index()
    {
        //ovde dobavljamo sve podatke iz tabele 
        //funkcija za dobavljanje svihpodataka iz tabele

        $locale = App::currentLocale();
        //ukoliko je en radimo sort po name_en a ako je sr po name_sr

        if($locale=='en'){
            $data = Genre::orderBy('name_en')->paginate(4);
        }elseif($locale=='sr'){
            $data = Genre::orderBy('name_sr')->paginate(4);
        }else{
            //all dovlaci sve podatke iz tabele genres
            $data = Genre::paginate(4);
        }     

        //onda treba da definisemo view kome prosledjujemo te podatke

        return view('genre.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     * //Create je za pripremu forme za unos
     * //priprema znaci da formi prosledimo sve podatke koji su neophodnida bi se ona generisala
     * //Npr ako imamo neke stranekljuceve mi moramo nekako da ih prosledimo viewu
     * //u ovom slucaju imamo jednostavnu tabelu pa je dovoljno da samo prosledimo view.
     */
    public function create()
    {
        return view('genre.create');

    }

    /**
     * Store a newly created resource in storage.
     * 
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|unique:genres,name_en|alpha',
            'name_sr' => 'nullable|unique:genres,name_sr|alpha'
        ]);
      
        //kod ispod se zavrsava u slucaju da je forma prosla validaciju
        //da bi create mogao da stavi vrednost nekog polja on mira da budeu filable. Moze da ima visak nikako manjak
        //1.nacin
        //Genre::create(['id'=>'4','name_en'=>'mistery','name_sr'=>'misterija']);

        //2.nacin instanca klase
        //$g = new Genre;
        // $g->id = 4;
        // $g->name_en = 'mistery';
        // $g->name_sr = 'misterija';
        // $g -> save();

        //bukvalno ovom komandom prihvatamo sve parametre iz requesta tj sto nam stize iz forme. I zamnjujemo prvi i drugi nacin. ALi nam je bitno da name u formi budu isti kao nazivi kolona u bazi.
        Genre::create($request->all()); 

        //ove poruke zive tacno jedan zahtev
        $request->session()
        ->flash('alertType', 'success');
        $request->session()
        ->flash('alertMsg', 'Successfully added.');

        return redirect()->route('genre.index');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * //form za izmenu nekog podatka
     * //On sam kaze $genre = Genre::find($request->input('id))
     * //potrebno je da viewu edit prosledimo jos jedan parametar u ovom slucaju zanr
     */
    public function edit(Genre $genre)
    {
        // return view('genre.edit',['genre'=>$genre]);
        return view('genre.edit',compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     * //cuvanje izmena
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'name_en' => ['required',
            // 'unique:genres,name_en',
            Rule::unique('genres','name_en')->ignore($genre->id),
            'alpha'],
            'name_sr' => ['nullable',
            // 'unique:genres,name_sr',
            Rule::unique('genres','name_sr')->ignore($genre->id),
            'alpha'],
        ]);

        $genre->update($request->all());
        
        //ove poruke zive tacno jedan zahtev
        $request->session()
        ->flash('alertType', 'success');
        $request->session()
        ->flash('alertMsg', 'Successfully updated.');

        return redirect()->route('genre.index');

    }

    /**
     * Remove the specified resource from storage.
     * //birsanje
     */
    public function destroy(Genre $genre)
    {
        $genre -> delete();

        try{
            session()
            ->flash('alertType', 'success');
            session()
            ->flash('alertMsg', 'Successfully deleted.');
    
            return redirect()->route('genre.index');
        }catch(Exception $e ){
            echo 'Message: '. $e->getMessage();
        }
        
    }
}
