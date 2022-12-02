<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpnModel extends Model
{
    use HasFactory;

    protected $table = 'vpn';

    protected $fillable = [
        'nama_vpn','id_user','id_paket','ip','port',
        'bayar','tgl_activ','tgl_inactiv'
    ];
}
