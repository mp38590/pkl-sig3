<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariabelPenilaian extends Model
{
    protected $primarykey = "";
    protected $table = "variabel_penilaian";
    protected $fillable =[
        'versi',
        'kode_penilaian',
        'item_penilaian',
        'nilai_maksimal',
        'inserted_by',
        'updated_by'
    ];
    // use HasFactory;
}
