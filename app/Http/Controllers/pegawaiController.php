<?php

namespace App\Http\Controllers;

use App\Models\pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Contracts\Service\Attribute\Required;

class pegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan data
        //kalau orderBy tinggal ditambah di pegawai::orderBy()
        $data = pegawai::paginate(2);
        return view('pegawai.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //value salah yang pernah dimasukan agar tidak ter-reset
        Session::flash('nip', $request->nip);
        Session::flash('nama', $request->nama);
        Session::flash('mapel', $request->mapel);
        //validasi
        $request->validate(
            [
                //siku pertama untuk validasi data
                'nip' => 'required|numeric|unique:pegawai,nip',
                'nama' => 'required',
                'mapel' => 'required'
                //akan diarahkan untuk membuat alert ke bagian blade
            ],
            [
                //siku ke dua berfungsi untuk memberi pesan sesuai yang diinginkan 
                'nip.required' => 'please fill your NIP',
                'nip.numeric' => 'your NIP must in numeric type',
                'nip.unique' => 'this NIP already exist in database',
                'nama.required' => 'please fill your Name',
                'mapel.required' => 'please fill your Mata Pelajaran'
            ]
        );
        $data = [
            'nip' => $request->nip,
            'nama' => $request->nama,
            'mapel' => $request->mapel,
        ];
        // memasukkan data diatas ke dalam tabel 
        pegawai::create($data);
        //disini kolom nim harus fillable lihat di "model"
        //validasi ada diatas $data

        //mengarahkan kembali input ke halaman depan dengan pesan sukses
        return redirect()->to('pegawai')->with('success', 'Your data have been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return "hi";
        $data = pegawai::where('nip', $id)->first(); //kalau get semua data diambil, first hanya data pertama
        return view('pegawai.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                //siku pertama untuk validasi data
                'nama' => 'required',
                'mapel' => 'required'
                //akan diarahkan untuk membuat alert ke bagian blade
            ],
            [
                //siku ke dua berfungsi untuk memberi pesan sesuai yang diinginkan
                'nama.required' => 'please fill your Name',
                'mapel.required' => 'please fill your Mata Pelajaran'
            ]
        );
        $data = [
            'nama' => $request->nama,
            'mapel' => $request->mapel,
        ];
        // memasukkan data diatas ke dalam tabel 
        pegawai::where('nip', $id)->update($data);
        //disini kolom nim harus fillable lihat di "model"
        //validasi ada diatas $data

        //mengarahkan kembali input ke halaman depan dengan pesan sukses
        return redirect()->to('pegawai')->with('success', 'Your data have been edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        pegawai::where('nip', $id)->delete();
        return redirect()->to('pegawai')->with('success', 'Your data have been deleted');
    }
}
