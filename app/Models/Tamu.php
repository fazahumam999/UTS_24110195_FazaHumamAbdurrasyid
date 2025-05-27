<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    protected $table = 'tamus';

    protected $fillable = [
        'nama',
        'nomor_identitas',
        'alamat',
        'telepon',
        'tanggal_checkin',
        'tanggal_checkout'
    ];
}

