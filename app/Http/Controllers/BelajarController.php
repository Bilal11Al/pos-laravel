<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index()
    {
        return view('belajar');
    }

    public function tambah()
    {
        return view('tambah');
    }

    public function kurang()
    {
        return view('kurang');
    }

    public function storeTambah(Request $request)
    {
        $angak1 = $request->angka1;
        $angak2 = $request->angka2;
        $jumlah = $angak1 + $angak2;
        return view('tambah',compact('jumlah'));
    }

    public function storeKurang(Request $request)
    {
        $angak1 = $request->angka1;
        $angak2 = $request->angka2;
        $kurang = $angak1 - $angak2;
        return view('kurang', compact('kurang'));
    }
}
