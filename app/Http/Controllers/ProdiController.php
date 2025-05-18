<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdiModel;
use App\Models\JurusanModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class ProdiController extends Controller
{
    // Menampilkan halaman utama program studi
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Program Studi',
            'list' => ['Home', 'Program Studi'],
        ];

        $page = (object) [
            'title' => 'Daftar program studi yang terdaftar dalam sistem',
        ];

        $activeMenu = 'prodi';

        return view('prodi.index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    // Mengambil data program studi untuk DataTables
    public function list(Request $request)
    {
        $prodi = ProdiModel::select('prodi_id', 'prodi_kode', 'prodi_nama', 'jurusan_id')
            ->with('jurusan');

        if ($request->filled('search_query')) {
            $prodi->where('prodi_nama', 'like', '%' . $request->search_query . '%');
        }

        if ($request->filled('jurusan_id')) {
            $prodi->where('jurusan_id', $request->jurusan_id);
        }

        return DataTables::of($prodi)
            ->addIndexColumn()
            ->addColumn('jurusan_nama', function ($row) {
                return $row->jurusan ? $row->jurusan->jurusan_nama : '-';
            })
            ->addColumn('aksi', function ($row) {
                $btn = '<button onclick="modalAction(\'' . url('/prodi/' . $row->prodi_id . '/show_ajax') . '\')" class="btn btn-info btn-sm me-1">Detail</button>';
                $btn .= '<button onclick="modalAction(\'' . url('/prodi/' . $row->prodi_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm me-1">Edit</button>';
                $btn .= '<button onclick="modalAction(\'' . url('/prodi/' . $row->prodi_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // Show AJAX detail program studi
    public function show_ajax(string $id)
    {
        $prodi = ProdiModel::find($id);
        if (!$prodi) {
            return response()->json(['status' => false, 'message' => 'Data program studi tidak ditemukan']);
        }
        $jurusan = JurusanModel::find($prodi->jurusan_id);
        return view('prodi.show_ajax', compact('prodi', 'jurusan'));
    }

    // Form tambah data ajax
    public function create_ajax()
    {
        $jurusan = JurusanModel::all();
        return view('prodi.create_ajax', compact('jurusan'));
    }

    // Store data ajax
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'prodi_kode' => 'required|string|max:20|unique:prodi,prodi_kode',
                'prodi_nama' => 'required|string|max:100',
                'jurusan_id' => 'required|exists:jurusan,jurusan_id',
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            try {
                ProdiModel::create($request->only('prodi_kode', 'prodi_nama', 'jurusan_id'));

                return response()->json([
                    'status' => true,
                    'message' => 'Data program studi berhasil disimpan',
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => false,
                    'message' => 'Gagal menyimpan data: ' . $e->getMessage(),
                ]);
            }
        }
        return redirect('/');
    }

    // Form edit ajax
    public function edit_ajax(string $id)
    {
        $prodi = ProdiModel::find($id);
        if (!$prodi) {
            return response()->json(['status' => false, 'message' => 'Data program studi tidak ditemukan']);
        }
        $jurusan = JurusanModel::all();
        return view('prodi.edit_ajax', compact('prodi', 'jurusan'));
    }

    // Update data ajax
    public function update_ajax(Request $request, string $id)
    {
        if (!$request->ajax()) {
            return response()->json(['status' => false, 'message' => 'Permintaan tidak valid']);
        }

        $rules = [
            'prodi_kode' => 'required|string|max:20|unique:prodi,prodi_kode,' . $id . ',prodi_id',
            'prodi_nama' => 'required|string|max:100',
            'jurusan_id' => 'required|exists:jurusan,jurusan_id',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'msgField' => $validator->errors(),
            ]);
        }

        $prodi = ProdiModel::find($id);
        if (!$prodi) {
            return response()->json(['status' => false, 'message' => 'Data program studi tidak ditemukan']);
        }

        try {
            $prodi->update($request->only('prodi_kode', 'prodi_nama', 'jurusan_id'));

            return response()->json([
                'status' => true,
                'message' => 'Data program studi berhasil diperbarui',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memperbarui data: ' . $e->getMessage(),
            ]);
        }
    }

    // Konfirmasi hapus ajax
    public function confirm_ajax(string $id)
    {
        $prodi = ProdiModel::find($id);
        if (!$prodi) {
            return response()->json(['status' => false, 'message' => 'Data program studi tidak ditemukan']);
        }
        return view('prodi.confirm_ajax', compact('prodi'));
    }

    // Form hapus ajax
    public function delete_ajax(string $id)
    {
        $prodi = ProdiModel::find($id);
        if (!$prodi) {
            return response()->json(['status' => false, 'message' => 'Data program studi tidak ditemukan']);
        }
        return view('prodi.delete_ajax', compact('prodi'));
    }
}
