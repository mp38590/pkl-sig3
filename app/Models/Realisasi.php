<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    protected $primarykey = "id";
    protected $table = "realisasi";
    protected $fillable =[
        'tahun',
        'item_penilaian',
        'deskripsi_item_penilaian',
        'kode_penilaian',
        'nilai',
        'inserted_by',
        'updated_by',
        'flag_delete'
    ];
    // use HasFactory;
}
