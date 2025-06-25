<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::all(); // Fetch all dosen
        return view('dosen.index', compact('dosen')); // Return the view with dosen data
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all(); // Fetch all prodi
        return view('dosen.create', compact('prodi')); // Show the form to create a new dosen
        // compact = to pass prodi data to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Dosen::class) || $request->user()->cannot('create', Prodi::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'nama' => 'required|unique:dosen|max:50',
            'nid' => 'required|max:20',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        Dosen::create($input);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        return view('dosen.show', compact('dosen')); // Return the view with dosen data
        // compact = to pass dosen data to the view
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        $prodi = Prodi::all(); // Fetch all prodi
        return view('dosen.edit', compact('dosen', 'prodi')); // Show the form to edit the dosen
        // compact = to pass dosen and prodi data to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dosen $dosen)
    {
        if ($request->user()->cannot('create', Dosen::class) || $request->user()->cannot('create', Prodi::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'nama' => 'required|unique:dosen',
            'nid' => 'required|max:20',
            'prodi_id' => 'required|exists:prodi,id',
        ]);

        $dosen->update($input);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen)
    {
        if ($dosen->jadwal()->exists()) {
            // If the dosen has associated jadwal, abort with a 403 error
            abort(403, 'Dosen cannot be deleted because it is associated with existing jadwal.');
        }

        $dosen->delete(); // Delete the dosen

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus.'); // Redirect back to the index with success message
    }
}
