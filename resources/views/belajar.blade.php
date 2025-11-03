@extends('layouts.app')

@section('content')
    <h1>Matematika dasar</h1>
    <a href="{{ route('belajar.tambah') }}">Tambah</a>
    <a href="{{ route('kurang') }}">Kurang</a>
    <a href="">Bagi</a>
    <a href="">Kali</a>
@endsection
