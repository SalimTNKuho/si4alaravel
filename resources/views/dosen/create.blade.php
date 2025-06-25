@extends('layout.main')
@section('title', 'Dosen')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <div class="card card-primary card-outline mb-4">
            <!--begin::Header-->
            <div class="card-header"><div class="card-title">Tambah Dosen</div></div>
            <!--end::Header-->
            <!--begin::Form-->
            <form action="{{ route('dosen.store') }}" method="POST">
            @csrf 
            <!--begin::Body-->
            <div class="card-body">
                <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" value="{{ old('nama') }}">
                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>
                
                <div class="mb-3">
                <label for="nid" class="form-label">NID</label>
                <input type="text" class="form-control" name="nid" value="{{ old('nid') }}">
                @error('nid')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                </div>

                <div class="mb-3">
                <label for="prodi_id" class="form-label">Program Studi</label>
                <select class="form-control" name="prodi_id">
                    @foreach ($prodi as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                </select>
                @error('prodi_id')
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