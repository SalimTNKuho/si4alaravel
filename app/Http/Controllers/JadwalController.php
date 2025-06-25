<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Dosen;
use App\Models\Sesi;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::all(); // Fetch all jadwal
        return view('jadwal.index', compact('jadwal')); // Return the view with jadwal data
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sesi = Sesi::all(); // Fetch all sesi
        $dosen = Dosen::all(); // Fetch all users
        $matakuliah = Matakuliah::all(); // Fetch all mata kuliah
        return view('jadwal.create', compact('sesi', 'dosen', 'matakuliah')); // Show the form to create a new jadwal
        // compact = to pass sesi, user, and matakuliah data to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Jadwal::class) || $request->user()->cannot('create', Matakuliah::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'tahun_akademik' => 'required|max:10',
            'kode_smt' => 'required|max:10',
            'kelas' => 'required|max:10',
            'matakuliah_id' => 'required|exists:matakuliah,id',
            'dosen_id' => 'required|exists:dosen,id',
            'sesi_id' => 'required|exists:sesi,id',
        ]);

        Jadwal::create($input);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        return view('jadwal.show', compact('jadwal')); // Return the view with jadwal data
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        $sesi = Sesi::all(); // Fetch all sesi
        $dosen = Dosen::all(); // Fetch all users
        $matakuliah = Matakuliah::all(); // Fetch all mata kuliah
        return view('jadwal.edit', compact('jadwal', 'sesi', 'dosen', 'matakuliah')); // Show the form to edit the jadwal
        // compact = to pass jadwal, sesi, user, and matakuliah data to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        if ($request->user()->cannot('create', Jadwal::class) || $request->user()->cannot('create', Matakuliah::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'tahun_akademik' => 'required|max:10',
            'kode_smt' => 'required|max:10',
            'kelas' => 'required|max:10',
            'matakuliah_id' => 'required|exists:matakuliah,id',
            'dosen_id' => 'required|exists:dosen,id',
            'sesi_id' => 'required|exists:sesi,id',
        ]);

        Jadwal::create($input);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        if ($jadwal->mahasiswa()->exists()) {
            // If the jadwal has associated mahasiswa, abort with a 403 error
            abort(403, 'Jadwal cannot be deleted because it is associated with mahasiswa.');
        }

        $jadwal->delete(); // Delete the jadwal

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.'); // Redirect with success message
    }
}
