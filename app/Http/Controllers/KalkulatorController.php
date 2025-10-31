<?php

namespace App\Http\Controllers;

use App\Models\Calculator;
use Illuminate\Http\Request;

class KalkulatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('calculator');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $a = $request->angka1;
        $b = $request->angka2;
        $hasil = 0;
        switch ($request->simbol) {
            case '*':
                $hasil =  $a * $b;
                break;
            case '+':
                $hasil =  $a + $b;
                break;
            case '_':
                $hasil =  $a - $b;
                break;
            case '/':
                $hasil = $b = $b != 0 ?  $a / $b : 0;
                break;
        }
        Calculator::create([
            'nilai1' => $a,
            'simbol' => $request->simbol,
            'nilai2' => $b,
            'hasil' => $hasil,
        ]);
        return view('calculator', compact('hasil'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
