@extends('layout.main')
@section('title', 'Nilai')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List Nilai</h3>
                </div>
                <div class="card-body">
                    @can('create', App\Models\Nilai::class)
                    <a href="{{ route('nilai.create') }}" class="btn btn-primary mb-3">Tambah</a>
                    @endcan
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                    <th>Mahasiswa</th>
                                    <th>Materi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $item)
                                    <tr>
                                        <td>{{ $item->nilai }}</td>
                                        <td>{{ $item->keterangan }}</td>
                                        <td>{{ $item->mahasiswa->nama }}</td>
                                        <td>{{ $item->materi->nama }}</td>
                                        <td>
                                            <a href="{{ route('nilai.show', $item->id) }}" class="btn btn-info btn-sm">Show</a>
                                            @can('update', $item)
                                            <a href="{{ route('nilai.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            @endcan
                                            @can('delete', $item)
                                            <form action="{{ route('nilai.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
