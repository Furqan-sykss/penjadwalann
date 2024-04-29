<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    use HasFactory;
    /**
     * fillable
     *
     * @var array
     */

    protected $fillable = [
        'tanggal', // tambahkan 'tanggal'
        'hari', // tambahkan 'hari'
        'tujuan', // tambahkan 'tujuan'
        'pemesanan_tiket', // tambahkan 'pemesanan_tiket'
        'berkas_pencarian', // tambahkan 'berkas_pencarian'
        'pencairan', // tambahkan 'pencairan'
        'catatan', // tambahkan 'catatan'
        'no_st_und', // tambahkan 'no_st_und'
    ];
}