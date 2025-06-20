<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materi = Materi::all(); // Fetch all materi without author relationship
        return view('materi.index', compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materi = Materi::all(); // Fetch all materi for the create view
        return view('materi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $materi = Materi::all(); // Fetch all materi for the store view
        if ($request->user()->cannot('create', Materi::class)) {
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'nama_materi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        Materi::create($input);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Materi $materi)
    {
        $materi = Materi::findOrFail($materi->id); // Fetch the materi by ID
        $materi->load(['mahasiswa', 'prodi']); // Load relationships
        return view('materi.show', compact('materi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Materi $materi)
    {
        return view('materi.edit', compact('materi')); // Simplified to only pass the materi
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materi $materi)
    {
        $materi = Materi::findOrFail($materi->id); // Fetch the materi by ID
        if ($request->user()->cannot('update', $materi)) {
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'nama_materi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
        ]);

        $materi->update($input);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Materi $materi)
    {
        $materi = Materi::findOrFail($materi->id); // Fetch the materi by ID
        if ($request->user()->cannot('delete', $materi)) {
            abort(403, 'Unauthorized action');
        }
        $materi->delete();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
