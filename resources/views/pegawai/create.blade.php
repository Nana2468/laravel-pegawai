@extends('layout.template')
@section('content')
    <div class="container m-5">
        <div class="card p-2">
            <div class="card-body ">
                <h4 class="mb-3">Add Data Pegawai</h4>
                @if ($errors->any())
                    <div class="pt-3">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <form action="{{ url('pegawai') }}" method="POST">
                    @csrf {{-- token agar page tidak expired --}}
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        {{-- value disini berfungsi untuk memanggil session yang sudah dibuat --}}
                        <input type="text" class="form-control" id="nip" placeholder="18 Digits" name="nip"
                            value="{{ Session::get('nip') }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" id="nama" placeholder="Fill Your Name"
                            name="nama" value="{{ Session::get('nama') }}">
                    </div>
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Mata Pelajaran</label>
                        <input type="text" class="form-control" id="mapel" placeholder="Fill Mata Pelajaran"
                            name="mapel" value="{{ Session::get('mapel') }}">
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="{{ url('pegawai') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
