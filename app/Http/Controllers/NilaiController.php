<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nilai = nilai::all();
        return view('nilai.index', compact('nilai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $prodi = Prodi::all();
        $materi = Materi::all();
        return view('nilai.create', compact('mahasiswa', 'prodi', 'materi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'dosen_id' => 'required|exists:dosen,id',
            'materi_id' => 'required|exists:materi,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        nilai::create($validatedData);

        return redirect()->route('nilai.index')->with('success', 'Nilai created successfully.');
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
        $prodi = Prodi::all();
        $materi = Materi::all();
        return view('nilai.edit', compact('nilai', 'mahasiswa', 'prodi', 'materi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nilai $nilai)
    {
        $validatedData = $request->validate([
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'dosen_id' => 'required|exists:dosen,id',
            'materi_id' => 'required|exists:materi,id',
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $nilai->update($validatedData);

        return redirect()->route('nilai.index')->with('success', 'Nilai updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nilai $nilai)
    {
        $nilai->delete();

        return redirect()->route('nilai.index')->with('success', 'Nilai deleted successfully.');
    }
}
