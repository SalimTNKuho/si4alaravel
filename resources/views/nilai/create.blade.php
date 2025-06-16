@extends('layout.main')
@section('title', 'Nilai')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Nilai</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Create Nilai</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Input Nilai</h3>
                </div>
                <form action="{{ route('nilai.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="student_id">Student ID</label>
                            <input type="text" name="mahasiswa_id" id="mahasiswa_id" class="form-control" placeholder="Enter Student ID" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Konten</label>
                            <input type="text" name="materi_id" id="materi_id" class="form-control" placeholder="Enter Subject" required>
                        </div>
                        <div class="form-group">
                            <label for="score">Nilai</label>
                            <input type="number" name="nilai_id" id="nilai_id" class="form-control" placeholder="Enter Score" required>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('nilai.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
