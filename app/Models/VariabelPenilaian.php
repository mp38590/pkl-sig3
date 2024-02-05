<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariabelPenilaian extends Model
{
    protected $primarykey = "item_penilaian";
    protected $table = "variabel_penilaian";
    protected $fillable =[
        'id',
        'versi',
        'kode_penilaian',
        'item_penilaian',
        'deskripsi_item_penilaian',
        'nilai_maksimal',
        'inserted_by',
        'updated_by',
        'flag_delete'
    ];

    public function realisasi()
    {
        return $this->hasMany(Realisasi::class);
    }
    // use HasFactory;
}
