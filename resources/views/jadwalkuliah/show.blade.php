@extends('layout.main') {{-- Assuming AdminLTE 4 layout is named 'main' --}}
@section('title', 'Jadwalkuliah')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">List Jadwalkuliah</h3>
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
                        <th>Tahun Akademik</th>
                        <td>{{ $jadwalkuliah->tahun_akademik }}</td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td>{{ $jadwalkuliah->kode_smt }}</td>
                    </tr>
                    <tr>
                        <th>Matakuliah</th>
                        <td>{{ $jadwalkuliah->matakuliah->nama }}</td>
                    </tr>
                    <tr>
                        <th>Dosen</th>
                        <td>{{ $jadwalkuliah->dosen->nama }}</td>
                    </tr>
                    <tr>
                        <th>sesi</th>
                        <td>{{ $jadwalkuliah->sesi->nama }}</td>
                    </tr>
                    </table>
            </div>
            <!--end::Footer-->
        </div>
        <!-- end::box -->
    </div>
    <!-- end::Row -->
@endsection