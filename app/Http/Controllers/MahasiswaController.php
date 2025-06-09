<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = mahasiswa::all();
        // dd($mahasiswa);
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all(); // ambil semua data prodi
        return view('mahasiswa.create', compact('prodi')); // menampilkan form create
        //compact = untuk mengambil data prodi ke mahasiswa
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // cek apakah user yang mengakses adalah admin
        if ($request->user()->cannot('create', Mahasiswa::class) || $request->user()->cannot('create', Prodi::class)) {
            // jika tidak, redirect ke route mahasiswa.index dengan pesan error
            abort(403, 'Unauthorized action');
        }
        
        // memvalidasi input
        $input = $request->validate([
            'nama' => 'required|unique:mahasiswa',
            'npm' => 'required|max:10',
            'jk' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'asal_sma' => 'required',
            'prodi_id' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi foto
        ]);

        // jika ada foto yang diupload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $input['foto'] = $filename; // simpan nama file ke database
        } else {
            $input['foto'] = null; // jika tidak ada foto, simpan null
        }

        // menyimpan data ke database
        Mahasiswa::create($input);

        // redirect ke route mahasiswa.index
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        // dd($mahasiswa);
        // menampilkan detail mahasiswa
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        // $mahasiswa = Mahasiswa::findOrFail($mahasiswa); // mencari mahasiswa berdasarkan id
        // dd($mahasiswa);
        // mengecek apakah mahasiswa id attributes ada
        
        $prodi = Prodi::all(); // ambil semua data prodi untuk dropdown
        // jika ada pilihan dari prodi nanti
        // dd($prodi); // untuk mengecek data prodi yang diambil
        // mengambil prodi dari mahasiswa

        $fakultas = $mahasiswa->prodi->fakultas; // mengambil fakultas dari prodi mahasiswa
        // dd($fakultas); // untuk mengecek data fakultas yang diambil
        // dd($mahasiswa->prodi); // untuk mengecek data prodi dari mahasiswa yang diambil

        return view('mahasiswa.edit', compact('mahasiswa', 'prodi', 'fakultas')); // menampilkan form edit mahasiswa
        // menampilkan form edit mahasiswa
        // return view('mahasiswa.edit', compact('mahasiswa', 'prodi', 'fakultas'));
        // return view('mahasiswa.edit', compact('mahasiswa', 'prodi')); 
        // return view('mahasiswa.edit', compact('mahasiswa'));
        // return view('mahasiswa.edit', ['mahasiswa' => $mahasiswa]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // mencari mahasiswa berdasarkan id
        // $mahasiswa = Mahasiswa::findOrFail($mahasiswa); // mencari mahasiswa berdasarkan id
        // dd($mahasiswa);

        // cek apakah user yang mengakses adalah admin
        if ($request->user()->cannot('create', Mahasiswa::class) || $request->user()->cannot('create', Prodi::class)) {
            // jika tidak, redirect ke route mahasiswa.index dengan pesan error
            abort(403, 'Unauthorized action');
        }

        // memvalidasi input
        $input = $request->validate([
            'nama' => 'required',
            'npm' => 'required|max:10',
            'jk' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_lahir' => 'required',
            'asal_sma' => 'required',
            'prodi_id' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validasi foto
        ]);

        // jika ada foto yang diupload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            $input['foto'] = $filename; // simpan nama file ke database
        } else {
            $input['foto'] = null; // jika tidak ada foto, simpan null
        }

        // update data mahasiswa
        $mahasiswa->update($input);
        
        // redirect ke route mahasiswa.index
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($mahasiswa)
    {
        // mengecek apakah mahasiswa id attributes ada
        // dd($mahasiswa);

        $mahasiswa = Mahasiswa::findOrFail($mahasiswa); // mencari mahasiswa berdasarkan id
        
        // menghapus foto jika ada
        // jika mahasiswa memiliki foto, hapus file foto tersebut
        if ($mahasiswa->foto) {
            $fotoPath = public_path('images/' . $mahasiswa->foto);
            if (file_exists($fotoPath)) {
                unlink($fotoPath); // menghapus file foto
            }
        }

        // menghapus data mahasiswa
        $mahasiswa->delete();

        // redirect ke route mahasiswa.index
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
