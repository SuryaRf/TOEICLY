<?php

namespace App\Http\Controllers;

use App\Models\ItcModel;
use Illuminate\Http\Request;
use App\Models\UserModel;

class ItcController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan halaman dashboard ITC
    public function index()
    {
        $data = ItcModel::all();
        return view('dashboard.itc.index', compact('data'));
    }

    // Halaman manajemen user ITC (opsional, jika mirip AdminController)
    public function manage()
    {
        $users = UserModel::with(['admin', 'mahasiswa', 'dosen', 'tendik', 'itc'])->get();
        return view('dashboard.itc.manage.index', compact('users'));
    }
}
