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
        $materi = Materi::with(['mahasiswa', 'prodi'])->paginate(10); // Use pagination and eager load relationships
        return view('materi.index', compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = Mahasiswa::all();
        $prodi = Prodi::all();
        return view('materi.create', compact('mahasiswa', 'prodi')); // Pass related data for the form
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Materi::class)) {
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'nama_materi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        Materi::create($input);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $materi = Materi::with(['mahasiswa', 'prodi'])->findOrFail($id); // Use findOrFail
        return view('materi.show', compact('materi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $materi = Materi::findOrFail($id); // Use findOrFail
        $mahasiswa = Mahasiswa::all();
        $prodi = Prodi::all();
        return view('materi.edit', compact('materi', 'mahasiswa', 'prodi')); // Pass related data for the form
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $materi = Materi::findOrFail($id); // Use findOrFail

        if ($request->user()->cannot('update', Materi::class)) {
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'nama_materi' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $materi->update($input);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $materi = Materi::findOrFail($id); // Use findOrFail
        $materi->delete();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
