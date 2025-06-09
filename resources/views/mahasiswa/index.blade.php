@extends('layout.main')
@section('title', 'Mahasiswa')

@section('content')
    <!--begin::Row-->
    <div class="row">
        <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">List Mahasiswa</h3>
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
                @can('create', App\Models\Mahasiswa::class)
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary"> Tambah </a>
                @endcan
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>NPM</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>Asal SMA/SMK</th>
                        <th>Program Studi</th>
                        <th>Fakultas</th>
                        <th>Aksi</th>
                        <th>Foto</th>
                    </tr>
                @foreach ($mahasiswa as $item)
                    <tr>
                        <td>{{ $item->nama }} </td>
                        <td>{{ $item->npm }} </td>
                        <td>{{ $item->jk }}</td>
                        <td>{{ $item->tanggal_lahir }}</td>
                        <td>{{ $item->tempat_lahir }}</td>
                        <td>{{ $item->asal_sma }}</td>
                        <td>{{ $item->prodi->nama }}</td>
                        <td>{{ $item->prodi->fakultas->nama }}</td>
                        <td>
                            <a href="{{ route('mahasiswa.show', $item->id) }}" class="btn btn-info">Show</a>
                            @can('update', $item)
                            <a href="{{ route('mahasiswa.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            @endcan
                            @can('delete', $item)
                            <form action="{{ route('mahasiswa.destroy', $item->id) }}" method="POST" class="d-inline">
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
                        <td><img src="images//{{ $item->foto }}" width="65px"></td>
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