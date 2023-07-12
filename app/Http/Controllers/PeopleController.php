<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //ovde dobavljamo sve podatke iz tabele 
        //funkcija za dobavljanje svihpodataka iz tabele
        
        $data = People::orderBy('name')->paginate(4);
        //onda treba da definisemo view kome prosledjujemo te podatke

        return view('people.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'b_date' => 'required|date'
        ]);

        People::create($request->all()); 

        //ove poruke zive tacno jedan zahtev
        $request->session()
        ->flash('alertType', 'success');
        $request->session()
        ->flash('alertMsg', 'Successfully added.');

        return redirect()->route('people.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(People $people)
    {
        return view('people.show',['people'=>$people]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(People $people)
    {
        return view('people.edit',compact('people'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, People $people)
    {
       $request->validate([
           'name' => 'required','alpha',
           'surname' => 'required|alpha',
           'b_date' => 'required|date'
           ]);

        $people->update($request->all());

        $request->session()
        ->flash('alertType', 'success');
        $request->session()
        ->flash('alertMsg', 'Successfully updated.');
        
        return redirect()->route('people.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(People $people)
    {
        $people -> delete();

        session()
        ->flash('alertType', 'success');
        session()
        ->flash('alertMsg', 'Successfully deleted.');

        return redirect()->route('people.index');
    }
}
