@extends('layout.template')
@section('content')
    <div class="container m-5">
        {{-- hasil dari redirect yang diarahkan ke session sukses --}}
        @if (Session::has('success'))
            <div class="">
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
        @endif
        <div class="d-flex justify-content-between">
            <h3 class="mb-3">Data Pegawai</h3>
            <a href="{{ url('pegawai/create') }}" class="mb-3 btn btn-light">Add Data</a>
        </div>
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>Mata Pelajaran</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = $data->firstItem(); ?>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->mapel }}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a href="{{ url('pegawai/' . $item->nip . '/edit') }}" class="btn btn-warning">Edit</a>
                                <form onsubmit="return confirm('Yakin akan menghapus data?')" class="d-inline"
                                    action="{{ url('pegawai/' . $item->nip) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php $no++; ?>
                @endforeach
            </tbody>
        </table>
        {{-- paginasi --}}
        {{ $data->links() }}
        {{-- tampilan belum bootstrap 5 arahkan ke appServiceProvider --}}
    </div>
@endsection
