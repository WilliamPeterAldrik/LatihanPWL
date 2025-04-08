<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mahasiswa.index')-> with('mahasiswas' , Mahasiswa::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nrp' => ['required','string','max:7','unique:mahasiswa,nrp'],
            'name' => ['required','string','max:150'],
            'birthdate' => ['required','date'],
            'address' => ['required','string','max:200'],
            'email' => ['nullable','string','email','max:255','unique:mahasiswa'],
            'phone' => ['required','string','max:16'],
            'profile_picture' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);
        if ($request->hasFile('profile_picture')) {
            $filename = $validateData['nrp'] . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $request->file('profile_picture')->storeAs('uploads', $filename);
            $mahasiswa['profile_picture'] = $filename;
        }
        $mahasiswa = new Mahasiswa($validatedData);
        $mahasiswa->save();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
}
