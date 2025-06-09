<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // panggil model Prodi menggunakan eloquent / db query builder
        $prodi = prodi::all(); // perintah SQL select * from prodi
        //dd($prodi); // dump and die, untuk menampilkan data ke layar
        return view('prodi.index')->with('prodi', $prodi); // selain with(), bisa menggunakan compact()
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::all(); // ambil semua data fakultas
        return view('prodi.create', compact('fakultas')); // menampilkan form create
        // compact = untuk mengambil data fakultas ke prodi
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // cek apakah user yang mengakses adalah admin
        if ($request->user()->cannot('create', Prodi::class) || $request->user()->cannot('create', Fakultas::class)) {
            // jika tidak, redirect ke route prodi.index dengan pesan error
            abort(403, 'Unauthorized action');
        }

        // memvalidasi input
        $input = $request->validate([
            'nama' => 'required|unique:prodi',
            'singkatan' => 'required|max:5',
            'kaprodi' => 'required',
            'sekretaris' => 'required',
            'fakultas_id' => 'required',
        ]);

        // menyimpan data ke database
        Prodi::create($input);

        // redirect ke route prodi.index
        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        // dd($prodi);
        return view('prodi.show', compact('prodi')); // menampilkan detail prodi
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        // mengecek apakah prodi id attributes ada
        // $prodi = Prodi::findOrFail($prodi); // mencari prodi berdasarkan id
        // menampilkan form edit prodi
        // dd($prodi);

        $fakultas = Fakultas::all(); // ambil semua data fakultas untuk dropdown
        // jika ada pilihan dari fakultas nanti
        // dd($fakultas); // untuk mengecek data fakultas yang diambil
        // dd($prodi->fakultas); // untuk mengecek data fakultas dari prodi yang diambil

        return view('prodi.edit', compact('prodi', 'fakultas')); // menampilkan form edit prodi
        // return view('prodi.edit', compact('prodi')); // menampilkan form edit prodi
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $prodi)
    {
        // mencari prodi berdasarkan id
        // $prodi = Prodi::findOrFail($prodi); // mencari prodi berdasarkan id
        // dd($prodi);

        // cek apakah user yang mengakses adalah admin
        if ($request->user()->cannot('create', Prodi::class) || $request->user()->cannot('create', Fakultas::class)) {
            // jika tidak, redirect ke route prodi.index dengan pesan error
            abort(403, 'Unauthorized action');
        }

        // memvalidasi input
        $input = $request->validate([
            'nama' => 'required',
            'singkatan' => 'required|max:5',
            'kaprodi' => 'required',
            'sekretaris' => 'required',
            'fakultas_id' => 'required',
        ]);

        // update data prodi
        $prodi->update($input);

        // redirect ke route prodi.index
        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($prodi)
    {
        // mengecek apakah prodi id attributes ada
        // dd($prodi);

        $prodi = Prodi::findOrFail($prodi); // mencari prodi berdasarkan id
        // jika prodi ditemukan, hapus 
        
        $prodi->delete(); // menghapus data prodi

        // redirect ke route prodi.index
        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil dihapus.');
    }
}
