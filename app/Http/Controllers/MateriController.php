<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Nilai;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    protected $materi;
    protected $mahasiswa;
    protected $prodi;
    protected $nilai;

    public function __construct(Materi $materi, Mahasiswa $mahasiswa, Prodi $prodi, Nilai $nilai)
    {
        $this->materi = $materi;
        $this->mahasiswa = $mahasiswa;
        $this->prodi = $prodi;
        $this->nilai = $nilai;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materi = $this->materi->with(['mahasiswa', 'prodi', 'nilai'])->get();
        return view('materi.index', compact('materi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mahasiswa = $this->mahasiswa->all();
        $prodi = $this->prodi->all();
        $nilai = $this->nilai->all();
        return view('materi.create', compact('mahasiswa', 'prodi', 'nilai'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateRequest($request);

        $this->materi->create($validatedData);

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
        $mahasiswa = $this->mahasiswa->all();
        $prodi = $this->prodi->all();
        $nilai = $this->nilai->all();
        return view('materi.edit', compact('materi', 'mahasiswa', 'prodi', 'nilai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materi $materi)
    {
        $validatedData = $this->validateRequest($request);

        $materi->update($validatedData);

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

    /**
     * Validate the incoming request data.
     */
    private function validateRequest(Request $request)
    {
        return $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'prodi_id' => 'required|exists:prodi,id',
            'nilai_id' => 'required|exists:nilai,id',
        ]);
    }
}
