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
        $materi = materi::all();
        // Load relationships if needed
        $materi->load(['mahasiswa', 'prodi', 'nilai']);
        return view('materi.index', compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materi = materi::all();
        return view('materi.create', compact('mahasiswa, prodi, nilai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // cek apakah user yang mengakses adalah admin
        if ($request->user()->cannot('create', Materi::class) || $request->user()->cannot('create', Nilai::class)) {
            // jika tidak, redirect ke route mahasiswa.index dengan pesan error
            abort(403, 'Unauthorized action');
        }

        // memvalidasi input
        $input = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'prodi_id' => 'required|exists:prodi,id',
            'nilai_id' => 'required|exists:nilai,id',
        ]);

        // menyimpan data ke database
        Materi::create($input);
        
        // redirect ke route materi.index

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Materi $materi)
    {
        $materi->load(['mahasiswa', 'prodi', 'nilai']);
        return view('materi.show', compact('materi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Materi $materi)
    {
        $materi = materi::all();
        $mahasiswa = Mahasiswa::all();
        $prodi = Prodi::all();
        $nilai = Nilai::all();
        return view('materi.edit', compact('materi', 'mahasiswa', 'prodi', 'nilai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materi $materi)
    {
        if ($request->user()->cannot('create', Mahasiswa::class) || $request->user()->cannot('create', Prodi::class)) {
            // jika tidak, redirect ke route mahasiswa.index dengan pesan error
            abort(403, 'Unauthorized action');
        }

        // memvalidasi input
        $input = $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'prodi_id' => 'required|exists:prodi,id',
            'nilai_id' => 'required|exists:nilai,id',
        ]);
        // mencari materi berdasarkan id
        $materi->update($input);

        return redirect()->route('materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materi $materi)
    {
        $materi->delete();

        return redirect()->route('materi.index')->with('success', 'Materi berhasil dihapus.');
    }

    // /**
    //  * Validate the incoming request data.
    //  */
    // public function validateRequest(Request $request)
    // {
    //     return $request->validate([
    //         'judul' => 'required|string|max:255',
    //         'konten' => 'required|string',
    //         'mahasiswa_id' => 'required|exists:mahasiswa,id',
    //         'prodi_id' => 'required|exists:prodi,id',
    //         'nilai_id' => 'required|exists:nilai,id',
    //     ]);
    // }
}
