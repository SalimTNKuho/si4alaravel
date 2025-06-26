@extends('layout.main')
@section('title', 'Nilai')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Tambah Nilai</div></div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{ route('nilai.store') }}" method="POST">
            @csrf 
            <!--begin::Body-->
            <div class="card-body">
                <div class="mb-3">
                <label for="nilai" class="form-label">Nilai</label>
                <input type="number" class="form-control" name="nilai" value="{{ old('nilai') }}">
                @error('nilai')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
                
                <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" name="keterangan" value="{{ old('keterangan') }}">
                @error('keterangan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
                <select class="form-control" name="mahasiswa_id">
                    @foreach ($mahasiswa as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
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
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
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