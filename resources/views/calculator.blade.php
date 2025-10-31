<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Kalkulator Lalaravel</title>
</head>

<body >
    <form action="{{ route('calculator,store') }}" method="POST"  >
        @csrf
        <label for="">Nilai 1</label>
        <input type="number" name="angka1">
        <br><br>
        <select name="simbol">
            <option value="">Masukan Simbol nya</option>
            <option value="*">*</option>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="/">/</option>
        </select>
        <br><br>
        <label for="">Nilai 2</label>
        <input type="number" name="angka2">
        <br><br>
        <p>Hasil {{ $hasil ?? 0 }}</p>
        <br><br>
        <button type="submit">Simpan</button>
    </form>
</body>

</html>
