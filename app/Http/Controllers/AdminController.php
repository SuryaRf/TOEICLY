<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;  // Pastikan model AdminModel sudah ada
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Pastikan menggunakan middleware auth agar hanya pengguna yang login yang bisa mengakses
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman dashboard admin
    public function index()
    {
        // Mendapatkan data admin
        $data = AdminModel::all();  // Menyesuaikan dengan data yang ingin ditampilkan

        // Mengirim data ke view
        return view('dashboard.admin.index', compact('data'));
    }
}
