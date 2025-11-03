@extends('layouts.app')

@section('content')
   <h1>Ini Pertambahan</h1>
    <form action="{{ route('storeTambah') }}" method="POST">
        @csrf
        <label for="">Angka 1</label>
        <input type="text" name="angka1">
        <br>
        <br>
        <label for="">Angka 2</label>
        <input type="text" name="angka2">
        <br>
        <br>
        <button type="submit">Simpan</button>
    </form>
    <p>Hasil nya adalah <strong>{{ $jumlah ?? 0}}</strong></p>
@endsection
