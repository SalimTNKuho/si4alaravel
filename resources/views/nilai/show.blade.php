@extends('layout.main') {{-- Assuming AdminLTE 4 layout is named 'main' --}}

@section('title', 'Nilai')

@section('content_header')
    <h1>Detail Nilai</h1>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Detail</h3>
    </div>
    <div class="card-body">
        <p><strong>ID:</strong> {{ $nilai->id }}</p>
        <p><strong>Nama:</strong> {{ $nilai->nama }}</p>
        <p><strong>Nilai:</strong> {{ $nilai->nilai }}</p>
        <p><strong>Keterangan:</strong> {{ $nilai->keterangan }}</p>
    </div>
    <div class="card-footer">
        <a href="{{ route('nilai.index') }}" class="btn btn-primary">Kembali</a>
    </div>
</div>
@endsection
