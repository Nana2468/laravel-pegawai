@extends('layout.template')
@section('content')
    <div class="container m-5">
        <div class="card p-2">
            <div class="card-body ">
                <h4 class="mb-3">Edit Data Pegawai</h4>
                <form action="{{ url('pegawai/' . $data->nip) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ $data->nip }}"
                            disabled>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama" value="{{ $data->nama }}"
                            name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                        <input type="text" class="form-control" id="mapel" value="{{ $data->mapel }}"
                            name="mapel">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ url('pegawai') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
