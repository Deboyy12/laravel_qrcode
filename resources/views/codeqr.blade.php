@extends('layouts.app')

@section('content')
<div class="text-center">
    <h2 class="text-4xl font-bold" style="font-size: 2rem !important;">🔗 QR Code Generator</h2><br>

    <!-- Form untuk Generate QR Code -->
    <form action="{{ route('qrcode.generate') }}" method="POST">
        @csrf
        <label>Masukkan URL:</label>
        <input type="text" name="url" required>

        <label>Ukuran QR Code:</label>
        <select name="size">
            <option value="200">Kecil (200x200)</option>
            <option value="300" selected>Sedang (300x300)</option>
            <option value="500">Besar (500x500)</option>
        </select>

        <label>Format QR Code:</label>
        <select name="format">
            <option value="svg" selected>SVG</option>
            <option value="png">PNG</option>
        </select>

        <button type="submit">🎯 Generate QR Code</button>
    </form><br><br><br>

    <!-- Jika QR Code dalam format SVG, tampilkan langsung -->
    @if (session('qr_code'))
        <div class="mt-4 flex justify-center">
            {!! session('qr_code') !!}
        </div>
    @endif<br><br>

    <!-- Jika QR Code tersimpan sebagai file, tampilkan gambar -->
    @if (session('file_url'))
        <div class="mt-4 flex justify-center">
            <br>
            <a href="{{ route('qrcode.download', basename(session('file_path'))) }}" class="btn btn-primary">
                ⬇️ Unduh QR Code
            </a>
        </div>
    @endif
</div>
@endsection
