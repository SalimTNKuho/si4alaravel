<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\User;
use App\Models\Sesi;
use App\Models\Mata_Kuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mata_Kuliah = Mata_Kuliah::all(); // Fetch all mata kuliah
        return view('mata_kuliah.index', compact('mata__kuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sesi = Sesi::all(); // Fetch all sesi
        $user = User::all(); // Fetch all users
        $prodi = Prodi::all(); // Fetch all prodi
        return view('mata_kuliah.create', compact('prodi')); // Show the form to create a new mata kuliah
        // compact = to pass prodi data to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Mata_Kuliah::class) || $request->user()->cannot('create', Prodi::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'kode_mk' => 'required|max:10',
            'nama' => 'required|max:50',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        Mata_Kuliah::create($input);

        return redirect()->route('mata_kuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mata_Kuliah $mata_Kuliah)
    {
        return view('mata_kuliah.show', compact('mata__kuliah'));
        // Show the details of a specific mata kuliah
        // The $mata_Kuliah variable is automatically injected by Laravel's route model binding
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mata_Kuliah $mata_Kuliah)
    {
        $prodi = Prodi::all();
        return view('mata_kuliah.edit', compact('mata__kuliah', 'prodi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mata_Kuliah $mata_Kuliah)
    {
        if ($request->user()->cannot('create', Mata_Kuliah::class) || $request->user()->cannot('create', Prodi::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'kode_mk' => 'required|max:10',
            'nama' => 'required|max:50',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        Mata_Kuliah::create($input);

        return redirect()->route('mata_kuliah.index')->with('success', 'Mata Kuliah berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mata_Kuliah $mata_Kuliah)
    {
        $mata_Kuliah->delete(); // Delete the mata kuliah

        return redirect()->route('mata_kuliah.index')->with('success', 'Mata Kuliah berhasil dihapus.');
        // Redirect to the mata kuliah index with a success message
    }
}
