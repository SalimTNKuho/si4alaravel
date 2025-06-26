<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Dosen;
use App\Models\Sesi;
use App\Models\Jadwalkuliah;
use Illuminate\Http\Request;

class JadwalkuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwalkuliah = Jadwalkuliah::all(); // Fetch all jadwal
        return view('jadwalkuliah.index', compact('jadwalkuliah')); // Return the view with jadwal data
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matakuliah = Matakuliah::all(); // Fetch all mata kuliah
        $dosen = Dosen::all(); // Fetch all users
        $sesi = Sesi::all(); // Fetch all sesi
        return view('jadwalkuliah.create', compact('matakuliah', 'dosen', 'sesi')); // Show the form to create a new jadwal
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Jadwalkuliah $jadwalkuliah)
    {
        if ($request->user()->cannot('create', Jadwalkuliah::class) || $request->user()->cannot('create', Matakuliah::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'tahun_akademik' => 'required|unique:jadwalkuliah',
            'kode_smt' => 'required|max:10',
            'kelas' => 'required|max:10',
            'matakuliah_id' => 'required|exists:matakuliah,id',
            'dosen_id' => 'required|exists:dosen,id',
            'sesi_id' => 'required|exists:sesi,id',
        ]);

        Jadwalkuliah::create($input);

        return redirect()->route('jadwalkuliah.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwalkuliah $jadwalkuliah)
    {
        return view('jadwalkuliah.show', compact('jadwalkuliah')); // Return the view with the specific jadwal data
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwalkuliah $jadwalkuliah)
    {
        $matakuliah = Matakuliah::all(); // Fetch all mata kuliah
        $dosen = Dosen::all(); // Fetch all dosen
        $sesi = Sesi::all(); // Fetch all sesi
        return view('jadwalkuliah.edit', compact('jadwalkuliah', 'matakuliah', 'dosen', 'sesi')); // Show the form to edit the specified jadwal
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwalkuliah $jadwalkuliah)
    {
        if ($request->user()->cannot('create', Jadwalkuliah::class) || $request->user()->cannot('create', Matakuliah::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'tahun_akademik' => 'required|unique:jadwalkuliah',
            'kode_smt' => 'required|max:10',
            'kelas' => 'required|max:10',
            'matakuliah_id' => 'required|exists:matakuliah,id',
            'dosen_id' => 'required|exists:dosen,id',
            'sesi_id' => 'required|exists:sesi,id',
        ]);

        $jadwalkuliah->update($input); // Update the jadwal with the validated input

        return redirect()->route('jadwalkuliah.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwalkuliah $jadwalkuliah)
    {
        $jadwalkuliah->delete(); // Delete the jadwal

        return redirect()->route('jadwalkuliah.index')->with('success', 'Jadwal berhasil dihapus.'); // Redirect with success message
    }
    
}
