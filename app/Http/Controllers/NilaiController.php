<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nilai = Nilai::with('mahasiswa', 'materi')->get();
        return view('nilai.index', compact('nilai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        return view('nilai.create', compact('mahasiswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'nilai' => 'required|unique:nilai|numeric',
            'keterangan' => 'required|string|max:255',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'materi_id' => 'required|exists:materi,id',
        ]);

        Nilai::create($input);
        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nilai $nilai)
    {
        $nilai->load(['mahasiswa', 'materi']);
        return view('nilai.show', compact('nilai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nilai $nilai)
    {
        $mahasiswa = Mahasiswa::all();
        return view('nilai.edit', compact('nilai', 'mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nilai $nilai)
    {
        $input = $request->validate([
            'nilai' => 'required|unique:nilai|numeric',
            'keterangan' => 'required|string|max:255',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'materi_id' => 'required|exists:materi,id',
        ]);

        $nilai->update($input);
        
        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil dihapus.');
    }
}
