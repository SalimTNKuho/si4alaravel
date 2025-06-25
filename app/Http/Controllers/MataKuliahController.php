<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\User;
use App\Models\Sesi;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matakuliah = Matakuliah::all(); // Fetch all mata kuliah
        return view('matakuliah.index', compact('matakuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sesi = Sesi::all(); // Fetch all sesi
        $user = User::all(); // Fetch all users
        $prodi = Prodi::all(); // Fetch all prodi
        return view('matakuliah.create', compact('prodi')); // Show the form to create a new mata kuliah
        // compact = to pass prodi data to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Matakuliah::class) || $request->user()->cannot('create', Prodi::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'kode_mk' => 'required|max:10',
            'nama' => 'required|max:50',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        Matakuliah::create($input);

        return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Matakuliah $matakuliah)
    {
        return view('matakuliah.show', compact('matakuliah'));
        // Show the details of a specific mata kuliah
        // The $matakuliah variable is automatically injected by Laravel's route model binding
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Matakuliah $matakuliah)
    {
        $prodi = Prodi::all();
        return view('matakuliah.edit', compact('matakuliah', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matakuliah $matakuliah)
    {
        if ($request->user()->cannot('create', Matakuliah::class) || $request->user()->cannot('create', Prodi::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'kode_mk' => 'required|max:10',
            'nama' => 'required|max:50',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        Matakuliah::create($input);

        return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete(); // Delete the mata kuliah

        return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah berhasil dihapus.');
        // Redirect to the mata kuliah index with a success message
    }
}
