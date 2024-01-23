<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Realisasi extends Model
{
    protected $primarykey = "objective_id";
    protected $table = "realisasi";
    protected $fillable =[
        'tahun',
        'item_penilaian',
        'kode_penilaian',
        'nilai',
        'objective_id',
        'inserted_by',
        'updated_by'
    ];
    // use HasFactory;
}
