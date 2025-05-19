<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdiModel;
use App\Models\JurusanModel;
use Illuminate\Support\Facades\Validator;

class ProdiController extends Controller
{
    // Tampilkan daftar prodi
    public function index()
    {
        // Eager load jurusan agar bisa ditampilkan
        $prodi = ProdiModel::with('jurusan')->orderBy('prodi_id')->get();
        return view('dashboard.admin.prodi.index', compact('prodi'));
    }

    // Tampilkan form tambah prodi
    public function create()
    {
        $jurusan = JurusanModel::orderBy('jurusan_nama')->get();
        return view('dashboard.admin.prodi.create', compact('jurusan'));
    }

    // Simpan data prodi baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'prodi_kode' => 'required|string|max:20|unique:prodi,prodi_kode',
            'prodi_nama' => 'required|string|max:50',
            'jurusan_id' => 'required|exists:jurusan,jurusan_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        ProdiModel::create([
            'prodi_kode' => $request->prodi_kode,
            'prodi_nama' => $request->prodi_nama,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect()->route('prodi.index')->with('success', 'Data program studi berhasil disimpan.');
    }

    // Tampilkan form edit prodi
    public function edit($id)
    {
        $prodi = ProdiModel::findOrFail($id);
        $jurusan = JurusanModel::orderBy('jurusan_nama')->get();
        return view('dashboard.admin.prodi.edit', compact('prodi', 'jurusan'));
    }

    // Update data prodi
    public function update(Request $request, $id)
    {
        $prodi = ProdiModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'prodi_kode' => 'required|string|max:20|unique:prodi,prodi_kode,' . $id . ',prodi_id',
            'prodi_nama' => 'required|string|max:50',
            'jurusan_id' => 'required|exists:jurusan,jurusan_id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $prodi->update([
            'prodi_kode' => $request->prodi_kode,
            'prodi_nama' => $request->prodi_nama,
            'jurusan_id' => $request->jurusan_id,
        ]);

        return redirect()->route('prodi.index')->with('success', 'Data program studi berhasil diperbarui.');
    }

    // Hapus data prodi
    public function destroy($id)
    {
        $prodi = ProdiModel::findOrFail($id);
        $prodi->delete();

        return redirect()->route('prodi.index')->with('success', 'Data program studi berhasil dihapus.');
    }
}
