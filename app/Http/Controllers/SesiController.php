<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sesi = Sesi::all(); // Fetch all sesi
        return view('sesi.index', compact('sesi')); // Return the view with sesi data
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sesi.create'); // Show the form to create a new sesi
        // compact = to pass prodi data to the view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Sesi::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'nama' => 'required|max:50',
        ]);

        Sesi::create($input);

        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sesi $sesi)
    {
        return view('sesi.show', compact('sesi')); // Return the view with sesi data
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sesi $sesi)
    {
        return view('sesi.edit', compact('sesi')); // Show the form to edit the sesi
        // compact = to pass sesi and prodi data to the view
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sesi $sesi)
    {
        if ($request->user()->cannot('create', Sesi::class)) {
            // If the user is not authorized, abort with a 403 error
            abort(403, 'Unauthorized action');
        }

        $input = $request->validate([
            'nama' => 'required|max:50',
        ]);

        Sesi::create($input);

        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil ditambahkan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sesi $sesi)
    {
        if ($sesi->jadwal()->exists()) {
            return redirect()->route('sesi.index')->with('error', 'Sesi tidak dapat dihapus karena memiliki jadwal terkait.');
        }

        $sesi->delete(); // Delete the sesi
        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil dihapus.'); // Redirect with success message
    }
}
