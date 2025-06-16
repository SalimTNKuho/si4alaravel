@extends('layout.main')
@section('title', 'Nilai')

@section('content')
<div class="container">
    <h1>Detail Nilai</h1>
    <div class="card">
        <div class="card-header">
            Detail
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $nilai->id }}</p>
            <p><strong>Nama:</strong> {{ $nilai->nama }}</p>
            <p><strong>Nilai:</strong> {{ $nilai->nilai }}</p>
            <p><strong>Keterangan:</strong> {{ $nilai->keterangan }}</p>
        </div>
    </div>
    <a href="{{ route('nilai.index') }}" class="btn btn-primary mt-3">Kembali</a>
</div>
@endsection
