@extends('layout.main')
@section('title', 'Nilai')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">List Nilai</h3>
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
            <div class="card-body">
                @can('create', App\Models\Nilai::class)
                <a href="{{ route('nilai.create') }}" class="btn btn-primary"> Tambah </a>
                @endcan
                <table>
                    <tr>
                        <th>Nilai</th>
                        <th>Keterangan</th>
                        <th>Mahasiswa</th>
                        <th>Materi</th>
                    </tr>
                @foreach ($prodi as $item)
                    <tr>
                        <td>{{ $item->nilai }} </td>
                        <td>{{ $item->keterangan }} </td>
                        <td>{{ $item->mahasiswa->nama }}</td>
                        <td>{{ $item->materi->nama }}</td>
                        <td>
                            <a href="{{ route('nilai.show', $item->id) }}" class="btn btn-info">Show</a>
                            @can('update', $item)
                            <a href="{{ route('nilai.edit', $item->id) }}" class="btn  btn-warning">Edit</a>
                            @endcan
                            @can('delete', $item)
                            <form action="{{ route('nilai.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                class="btn btn-danger show_confirm" 
                                data-toggle="tooltip" 
                                title='Delete' 
                                data-nama='{{ $item->nilai }}'>Delete</button>
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
