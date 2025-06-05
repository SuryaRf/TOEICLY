<?php

namespace App\Http\Controllers;

use App\Models\InformasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InformasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the information records.
     */
    public function index()
    {
        $informasis = InformasiModel::with('admin')->latest()->get();
        return view('informasi.index', compact('informasis'));
    }

    /**
     * Show the form for creating a new information record.
     */
    public function create()
    {
        return view('informasi.create');
    }

    /**
     * Store a newly created information record in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
        ]);

        InformasiModel::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'admin_id' => Auth::user()->admin->admin_id ?? null,
        ]);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified information record.
     */
    public function edit($id)
    {
        $informasi = InformasiModel::findOrFail($id);
        return view('informasi.edit', compact('informasi'));
    }

    /**
     * Update the specified information record in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
        ]);

        $informasi = InformasiModel::findOrFail($id);
        $informasi->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'admin_id' => Auth::user()->admin->admin_id ?? null,
        ]);

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil diperbarui.');
    }

    /**
     * Remove the specified information record from storage.
     */
    public function destroy($id)
    {
        $informasi = InformasiModel::findOrFail($id);
        $informasi->delete();

        return redirect()->route('informasi.index')->with('success', 'Informasi berhasil dihapus.');
    }
}