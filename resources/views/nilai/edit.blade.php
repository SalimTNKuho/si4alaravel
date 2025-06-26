@extends('layout.main') {{-- Assuming AdminLTE 4 layout is named 'app' --}}
@section('title', 'Nilai')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Ubah Nilai</div></div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
            @csrf 
            @method('PUT')
            <!--begin::Body-->
            <div class="card-body">
                <div class="mb-3">
                <label for="Nilai" class="form-label">Nilai</label>
                <input type="text" class="form-control" name="Nilai" value="{{ old('nilai') ? old('nilai') : $nilai->nilai }}">
                @error('nilai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
                
                <div class="mb-3">
                <label for="keterangan" class="form-label">keterangan</label>
                <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan') ? old('keterangan') : $prodi->singkatan }}">
                @error('keterangan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
                
                <div class="mb-3">
                <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
                <select class="form-control" name="mahasiswa_id">
                    @foreach ($mahasiswa as $item)
                        <option value="{{ $item->id }}" {{ old('mahasiswa_id') == $item->id ? 'selected' : ($mahasiswa->mahasiswa_id == $item->id ? 'selected' : null) }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('mahasiswa_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                <label for="materi_id" class="form-label">Materi</label>
                <select class="form-control" name="materi_id">
                    @foreach ($materi as $item)
                        <option value="{{ $item->id }}" {{ old('materi_id') == $item->id ? 'selected' : ($materi->materi_id == $item->id ? 'selected' : null) }}>{{ $item->judul }}</option>
                    @endforeach
                </select>
                @error('materi_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <!--end::Footer-->
            </form>
            <!--end::Form-->
        </div>
        </div>
    </div>
    <!--end::Row-->
@endsection