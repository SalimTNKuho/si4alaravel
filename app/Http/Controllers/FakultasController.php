<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // pangggil model Fakultas menggunakan eloquent / db query builder
        $fakultas = Fakultas::all(); // perintah SQL select * from fakultas
        // dd($fakultas); // dump and die, untuk menampilkan data ke layar
        return view('fakultas.index', compact('fakultas')); // selain compact, bisa menggunakan with()
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all(); // ambil semua data prodi
        // jika ada pilihan dari prodi nanti
        return view('fakultas.create'); // menampilkan form create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // cek apakah user yang mengakses adalah admin
        if ($request->user()->cannot('create', Fakultas::class)) {
            // jika tidak, redirect ke route fakultas.index dengan pesan error
            abort(403, 'Unauthorized action');
        }

        // memvalidasi input
        $input = $request->validate([
            'nama' => 'required|unique:fakultas',
            'singkatan' => 'required|max:5',
            'dekan' => 'required',
            'wakil_dekan' => 'required',
        ]);

        // menyimpan data ke database
        Fakultas::create($input);

        // redirect ke route fakultas.index
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($fakultas)
    {
        // menampilkan detail fakultas
        $fakultas = Fakultas::findOrFail($fakultas); // mencari fakultas berdasarkan id
        // dd($fakultas);
        return view('fakultas.show', compact('fakultas')); // menampilkan detail fakultas
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($fakultas)
    {
        $fakultas = Fakultas::findOrFail($fakultas);
        // dd($fakultas);
        return view('fakultas.edit', compact('fakultas'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $fakultas)
    {
        $fakultas = Fakultas::findOrFail($fakultas); // mencari fakultas berdasarkan id
        
        // cek apakah user yang mengakses adalah admin
        if($request->user()->cannot('update', $fakultas)) {
            // jika tidak, redirect ke route fakultas.index dengan pesan error
            abort(403, 'Unauthorized action');
        }

        // validasi input
        $input = $request->validate([
            'nama' => 'required',
            'singkatan' => 'required|max:5',
            'dekan' => 'required',
            'wakil_dekan' => 'required',
        ]);

        // update data fakultas
        $fakultas->update($input); // perintah SQL update fakultas set nama = $input['nama'], singkatan = $input['singkatan'], dekan = $input['dekan'], wakil_dekan = $input['wakil_dekan'] where id = $fakultas->id

        // redirect ke route fakultas.index
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $fakultas)
    {
        $fakultas = Fakultas::findOrFail($fakultas); // mencari fakultas berdasarkan id
        // dd($fakultas);

        // cek apakah user yang mengakses adalah admin
        if ($request->user->cannot('delete', $fakultas)) {
            // jika tidak, redirect ke route fakultas.index dengan pesan error
            abort(403, 'Unauthorized action');
        }

        // menghapus data fakultas
        $fakultas->delete(); // perintah SQL delete from fakultas where id = $fakultas->id

        // redirect ke route fakultas.index
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil dihapus.');
    }
}
