@extends('layout.main')
@section('title', 'Jadwal')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">List Jadwal</h3>
            <div class="card-tools">
                <button
                type="button"
                class="btn btn-tool"
                data-lte-toggle="card-collapse"
                title="Collapse"
                >
                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                </button>
                <button
                type="button"
                class="btn btn-tool"
                data-lte-toggle="card-remove"
                title="Remove"
                >
                <i class="bi bi-x-lg"></i>
                </button>
            </div>
            </div>
            <div class="card-body">
                @can('create', App\Models\Jadwal::class)
                    <a href="{{ route('jadwal.create') }}" class="btn btn-primary"> Tambah </a>
                @endcan
                <table>
                    <tr>
                        <th>Tahun Akademik</th>
                        <th>Semester</th>
                        <th>Kelas</th>
                        <th>Mata Kuliah</th>
                        <th>Dosen</th>
                        <th>Sesi</th>
                    </tr>
                @foreach ($jadwal as $item)
                    <tr>
                        <td>{{ $item->tahun_akademik }} </td>
                        <td>{{ $item->kode_smt }} </td>
                        <td>{{ $item->mata_kuliah->nama }}</td>
                        <td>{{ $item->dosen->nama }}</td>
                        <td>{{ $item->sesi->nama }}</td>
                        <td>
                            <a href="{{ route('jadwal.show', $item->id) }}" class="btn btn-info">Show</a>
                            @can('update', $item)
                            <a href="{{ route('jadwal.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete', $item)
                            <form action="{{ route('jadwal.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                class="btn btn-danger show_confirm" 
                                data-toggle="tooltip" 
                                title='Delete' 
                                data-nama='{{ $item->nama }}'>Delete</button>
                            </form>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </table>    
            </div>
            <!-- /.card-body -->
            <div class="card-footer">Footer</div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        </div>
    </div>
    <!--end::Row-->
@endsection