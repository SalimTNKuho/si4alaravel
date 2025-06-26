<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materi = Materi::all(); // Fetch all materi
        return view('materi.index', compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Materi $materi)
    {
        $input = $request->validate([
            'judul' => 'required|string|max:255',
            'nama_materi' => 'required|unique:materi',
            'konten' => 'required|string',
        ]);

        Materi::create($input);
        // // Create a new materi instance and fill it with validated data
        // $materi = new Materi();
        // $materi->fill($input);
        // // Save the materi to the database
        // $materi->save();
        // // Redirect to the materi index with a success message

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi)
    {
        return view('materi.show', compact('materi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materi $materi)
    {
        return view('materi.edit', compact('materi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materi $materi)
    {
        $input = $request->validate([
            'judul' => 'required|string|max:255',
            'nama_materi' => 'required|unique:materi',
            'konten' => 'required|string',
        ]);

        $materi->update($input);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $materi)
    {
        $materi = Materi::findOrFail($materi);

        $materi->delete();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
