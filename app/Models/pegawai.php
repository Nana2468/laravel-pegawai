<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    use HasFactory;
    //memberi perizinan agar fillable
    protected $fillable = ['nip', 'nama', 'mapel'];
    //disini akan tampil table laravel_pegawai.pegawais doesnt exist
    //maka perlu identifikasi nama tabel
    protected $table = 'pegawai';
    //disini akan muncul column not found, karena ketika membuat model maka controller juga dijalankan
    //perlu diberi informasi bahwa kita tidak pakai timestamp
    public $timestamps = false;
}
