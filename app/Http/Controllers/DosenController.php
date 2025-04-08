<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dosen.index')-> with('dosens' , Dosen::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nik' => 'required|string|max:7|unique:dosen,nik',
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:50|unique:dosen,email',
            'tanggal_lahir' => 'required|date',
        ]);
    
        Dosen::create($validateData);
    
        return redirect(route('dosenList'))->with('success', 'Data dosen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit')->with('dosen', $dosen);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $nik)
    {
        $dosen = Dosen::find($nik);
        // Validasi input
        $validateData = $request->validate([
            'nik' => ['required', 'string', 'max:7', Rule::unique('dosen', 'nik')->ignore($dosen->nik, 'nik')],
            'name' => 'required|string|max:100',
            'email' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

    
        // Update data dosen
        $dosen['name'] = $validateData['name'];
        $dosen['email'] = $validateData['email'];
        $dosen['tanggal_lahir'] = $validateData['tanggal_lahir'];
        $dosen->save();
    
        // Redirect dengan pesan sukses
        return redirect(route('dosenList'))->with('success', 'Data dosen berhasil diubah');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        $dosen -> delete();
        return redirect(route('dosenList'));
    }
}
