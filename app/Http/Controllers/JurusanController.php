<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JurusanModel;
use App\Models\KampusModel; // Untuk pilihan kampus di form

class JurusanController extends Controller
{
    public function index()
    {
        $data = JurusanModel::all();
        return view('dashboard.admin.jurusan.index', compact('data'));
    }

    public function create()
    {
        $kampus = KampusModel::orderBy('kampus_nama')->get(); // ambil data kampus utk dropdown
        return view('dashboard.admin.jurusan.create', compact('kampus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_kode' => 'required|string|max:10|unique:jurusan,jurusan_kode',
            'jurusan_nama' => 'required|string|max:100',
            'kampus_id' => 'required|exists:kampus,kampus_id',
        ]);

        JurusanModel::create([
            'jurusan_kode' => $request->jurusan_kode,
            'jurusan_nama' => $request->jurusan_nama,
            'kampus_id' => $request->kampus_id,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil ditambahkan.');
    }
    public function destroy($id)
    {
        $jurusan = JurusanModel::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil dihapus.');
    }
     public function edit($id)
    {
        $jurusan = JurusanModel::findOrFail($id);
        $kampus = KampusModel::orderBy('kampus_nama')->get(); // data kampus utk dropdown
        return view('dashboard.admin.jurusan.edit', compact('jurusan', 'kampus'));
    }

    // Method untuk proses update
    public function update(Request $request, $id)
    {
        $jurusan = JurusanModel::findOrFail($id);

        $request->validate([
            'jurusan_kode' => 'required|string|max:10|unique:jurusan,jurusan_kode,' . $id . ',jurusan_id',
            'jurusan_nama' => 'required|string|max:100',
            'kampus_id' => 'required|exists:kampus,kampus_id',
        ]);

        $jurusan->update([
            'jurusan_kode' => $request->jurusan_kode,
            'jurusan_nama' => $request->jurusan_nama,
            'kampus_id' => $request->kampus_id,
        ]);

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil diperbarui.');
    }
}
