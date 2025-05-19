<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KampusModel;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KampusController extends Controller
{
    // Tampilkan daftar kampus
public function index()
{
    $kampus = KampusModel::orderBy('kampus_id')->get();
    return view('dashboard.admin.kampus.index', compact('kampus'));
}



    // Tampilkan form tambah kampus
    public function create()
    {
        return view('dashboard.admin.kampus.create');
    }

    // Simpan data kampus baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kampus_kode' => 'required|string|max:10|unique:kampus,kampus_kode',
            'kampus_nama' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        KampusModel::create([
            'kampus_kode' => $request->kampus_kode,
            'kampus_nama' => $request->kampus_nama,
        ]);

        return redirect()->route('dashboard.admin.kampus.index')->with('success', 'Data kampus berhasil disimpan.');
    }

    // Tampilkan form edit kampus
    public function edit($id)
    {
        $kampus = KampusModel::findOrFail($id);
        return view('kampus.edit', compact('kampus'));
    }

    // Update data kampus
    public function update(Request $request, $id)
    {
        $kampus = KampusModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kampus_kode' => 'required|string|max:10|unique:kampus,kampus_kode,' . $id . ',kampus_id',
            'kampus_nama' => 'required|string|max:10',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kampus->update([
            'kampus_kode' => $request->kampus_kode,
            'kampus_nama' => $request->kampus_nama,
        ]);

        return redirect()->route('dashboard.admin.kampus.index')->with('success', 'Data kampus berhasil diperbarui.');
    }

    // Hapus data kampus
    public function destroy($id)
    {
        $kampus = KampusModel::findOrFail($id);
        $kampus->delete();

        return redirect()->route('dashboard.admin.kampus.index')->with('success', 'Data kampus berhasil dihapus.');
    }
    public function list(Request $request)
{
    $kampus = KampusModel::select('kampus_id', 'kampus_kode', 'kampus_nama');

    if ($request->has('search_query') && $request->search_query != '') {
        $kampus->where('kampus_nama', 'like', '%' . $request->search_query . '%');
    }

    return DataTables::of($kampus)
        ->addIndexColumn()
        ->addColumn('aksi', function ($k) {
            $btn = '<button onclick="modalAction(\'' . url('/kampus/' . $k->kampus_id . '/show_ajax') . '\')" class="btn btn-info btn-sm me-1">Detail</button>';
            $btn .= '<button onclick="modalAction(\'' . url('/kampus/' . $k->kampus_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm me-1">Edit</button>';
            $btn .= '<button onclick="modalAction(\'' . url('/kampus/' . $k->kampus_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

}
