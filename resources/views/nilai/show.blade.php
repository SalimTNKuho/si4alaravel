@extends('layout.main') {{-- Assuming AdminLTE 4 layout is named 'main' --}}
@section('title', 'Nilai')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">List Fakultas</h3>
            <div class="card-tools">
                <button
                type="button"
                class="btn btn-tool"
                data-lte-toggle="card-collapse"
                title="Collapse">
                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                </button>
                <button
                type="button"
                class="btn btn-tool"
                data-lte-toggle="card-remove"
                title="Remove">
                <i class="bi bi-x-lg"></i>
                </button>
                </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Nilai</th>
                        <td>{{ $nilai->nilai }}</td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>{{ $nilai->keterangan }}</td>
                    </tr>
                    <tr>
                        <th>Mahasiswa</th>
                        <td>{{ $nilai->mahasiswa->nama }}</td>
                    </tr>
                    <tr>
                        <th>Wakil Dekan</th>
                        <td>{{ $nilai->materi->materi_id }}</td>
                    </tr>
                </table>
            </div>
            <!--end::Footer-->
        </div>
        <!-- end::box -->
    </div>
    <!-- end::Row -->
@endsection